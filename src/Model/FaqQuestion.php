<?php

namespace Hestec\FaqPage;

use SilverStripe\ORM\DataObject;
use SilverStripe\CMS\Model\SiteTree;

class FaqQuestion extends DataObject {

    private static $table_name = 'HestecFaqQuestion';

    private static $singular_name = 'Question';
    private static $plural_name = 'Questions';

    private static $db = [
        'Question' => 'Varchar(255)',
        'Answer' => 'HTMLText',
        'Sort' => 'Int'
    ];

    private static $has_one = [
        'Category' => FaqCategorie::class,
        'Page' => SiteTree::class
    ];

    private static $summary_fields = [
        'Question',
        'Created'
    ];

    private static $default_sort = 'Sort';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Sort');
        $fields->removeByName('CategoryID');
        $fields->removeByName('PageID');

        return $fields;
    }

    public function getTitle(){
        return $this->Question;
    }

}
