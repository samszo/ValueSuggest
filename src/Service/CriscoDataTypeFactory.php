<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Crisco\Crisco;
use Zend\ServiceManager\Factory\FactoryInterface;

class CriscoDataTypeFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Crisco($services);
        return $dataType;
    }
}
