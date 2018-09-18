<?php

namespace Hestec\Faqpage;

use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class FaqPage extends \Page {

    private static $table_name = 'HestecFaqPage';

    private static $has_many = [
        'Categories' => FaqCategorie::class
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $gridConfig = GridFieldConfig_RecordEditor::create();
        $gridConfig->addComponent(new GridFieldOrderableRows());
        $fields->addFieldToTab('Root.Categories', new GridField('Categories', _t(self::class . '.CATEGORIES', 'Categories'), $this->Categories(), $gridConfig));

        return $fields;
    }

}
