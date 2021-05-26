<?php

namespace GGrach\Multiregionality\Entity;

class Region {

    protected $id;
    protected $name;
    protected $isDefaultRegion;
    protected $nameForms = [];
    protected $url;
    protected $data = [];

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getNameForms(): array {
        return $this->nameForms;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getData(): array {
        return $this->data;
    }

    public function getProperty(string $propertyCode) {
        return array_column($this->getData(), $propertyCode.'_VALUE');
    }

    public function isDefaultRegion(): bool {
        return $this->isDefaultRegion === true;
    }


    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setIsDefaultRegion(bool $isDefaultRegion): void {
        $this->isDefaultRegion = $isDefaultRegion;
    }

    public function setNameForms(array $nameForms): void {
        $this->nameForms = $nameForms;
    }

    public function setUrl($url): void {
        $this->url = $url;
    }

    public function setData($data): void {
        $this->data = $data;
    }

}
