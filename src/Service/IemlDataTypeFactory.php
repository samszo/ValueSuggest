<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Ieml\Ieml;
use Zend\ServiceManager\Factory\FactoryInterface;

class IemlDataTypeFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Ieml($services);
        return $dataType;
    }
}
