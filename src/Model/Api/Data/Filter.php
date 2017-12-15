<?php

namespace Hatimeria\Reagento\Model\Api\Data;

use Hatimeria\Reagento\Api\Data\FilterInterface;
use Hatimeria\Reagento\Api\Data\FilterExtensionInterface;
use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\Phrase;

class Filter extends AbstractExtensibleModel implements FilterInterface
{
    /**
     * @return string
     */
    public function getLabel()
    {
        return (string)$this->_getData(self::LABEL);
    }

    /**
     * @param string|Phrase $label
     * @return \Hatimeria\Reagento\Api\Data\FilterInterface
     */
    public function setLabel($label)
    {
        return $this->setData(self::LABEL, $label);
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->_getData(self::CODE);
    }

    /**
     * @param string $code
     * @return \Hatimeria\Reagento\Api\Data\FilterInterface
     */
    public function setCode($code)
    {
        return $this->setData(self::CODE, $code);
    }

    /**
     * @return int
     */
    public function getAttributeId()
    {
        return $this->_getData(self::ATTRIBUTE_ID);
    }

    /**
     * @param int $attributeId
     * @return \Hatimeria\Reagento\Api\Data\FilterInterface
     */
    public function setAttributeId($attributeId)
    {
        return $this->setData(self::ATTRIBUTE_ID);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_getData(self::TYPE);
    }

    /**
     * @param string $type
     * @return \Hatimeria\Reagento\Api\Data\FilterInterface;
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * @return \Hatimeria\Reagento\Api\Data\FilterOptionInterface[]
     */
    public function getOptions()
    {
        return $this->_getData(self::OPTIONS);
    }

    /**
     * @param \Hatimeria\Reagento\Api\Data\FilterOptionInterface[] $options
     * @return \Hatimeria\Reagento\Api\Data\FilterInterface
     */
    public function setOptions($options)
    {
        return $this->setData(self::OPTIONS, $options);
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        /** @var FilterExtensionInterface $extensionAttributes */
        $extensionAttributes = $this->_getExtensionAttributes()
            ?: $this->extensionAttributesFactory->create(FilterInterface::class);

        return $extensionAttributes;
    }

    /**
     * @inheritDoc
     */
    public function setExtensionAttributes(FilterExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}