<?php

namespace Hestec\FaqPage;
use Spatie\SchemaOrg\Schema;

class FaqPageController extends \PageController {

    public function SchemaFaqPage()
    {

        $questions = array();

        foreach ($this->Categories()->sort('Sort') as $cat){

            foreach (FaqQuestion::get()->filter('CategoryID', $cat->ID)->sort('Sort') as $q){

                $a = Schema::answer();

                $answer = preg_replace('/\[(\w+)[^\]]*]([^\[]+\[\\?\/\1\])?/', ' ', strip_tags($q->Answer));

                /* The above regex should remove the whole embed inserts, see: https://regex101.com/r/Eaj73B/8)
                But in php7.2 it doesn't for some unknow reason, see also: https://bit.ly/2KD5Ipa (stackoverflow)
                That's we we remove the closing embed here with str_replace. But this doesn't remove the url between the tags. */

                $a->text(str_replace('[/embed]', ' ', $answer));

                $qa = Schema::question();
                $qa->name($q->Question);
                $qa->acceptedAnswer($a);

                array_push($questions, $qa);

            }

        }

        $faqpage = Schema::fAQPage();
        $faqpage->identifier($this->AbsoluteLink().'#faq');
        $faqpage->url($this->AbsoluteLink());
        $faqpage->inLanguage($this->ContentLocale());
        $faqpage->name($this->MetaTitle);
        $faqpage->description($this->MetaDescription);
        $faqpage->datePublished($this->Created);
        $faqpage->dateModified($this->LastEdited);
        $faqpage->isPartOf($this->SchemaWebsite());
        $faqpage->mainEntity($questions);

        return $faqpage;

    }

}
