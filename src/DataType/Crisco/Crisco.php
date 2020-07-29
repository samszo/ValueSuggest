<?php
namespace ValueSuggest\DataType\Crisco;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Crisco\CriscoSuggest;

class Crisco extends AbstractDataType
{
    public function getSuggester()
    {
        return new CriscoSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:crisco:synonyme';
    }

    public function getLabel()
    {
        return 'Crisco: Dictionnaire Electronique des Synonymes (DES)'; // @translate
    }
}
