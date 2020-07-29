<?php
namespace ValueSuggest\DataType\Ieml;

use ValueSuggest\DataType\AbstractDataType;
use ValueSuggest\Suggester\Ieml\IemlSuggest;

class Ieml extends AbstractDataType
{
    public function getSuggester()
    {
        return new IemlSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:ieml:label';
    }

    public function getLabel()
    {
        return 'IEML : Information Economy Meta-Language'; // @translate
    }
}
