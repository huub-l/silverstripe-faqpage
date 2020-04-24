<?php

namespace Hestec\FaqPage;
use Spatie\SchemaOrg\Schema;

class FaqPageController extends \PageController {

    public function SchemaFaqPage()
    {

        $questions = array();

        foreach ($this->Categories() as $cat){

            foreach (FaqQuestion::get()->filter('CategoryID', $cat->ID) as $q){

                $a = Schema::answer();
                $a->text(preg_replace('/\[(\w+)[^\]]*]([^\[]+\[\\?\/\1\])?/', '', strip_tags($q->Answer)));

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
