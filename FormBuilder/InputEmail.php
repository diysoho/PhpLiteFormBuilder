<?php

/**
 * Lite form builder library
 * @author Martin Forejt
 */
class InputEmail extends Input {

    private $placeholder;

    public function __construct($divId = null, $divClasses = array()){
        parent::__construct($divId, $divClasses);
    }

    public function setPlaceholder($placeholder = 'Email'){
        $this->placeholder = $placeholder;
        return $this;
    }

    public function setLabel($label = 'Email'){
        if(is_string($label)){
            $label = new Label($label);
            $this->label = $label;
            $this->label->setInputId($this->id);
        }
        elseif($label instanceof Label){
                $this->label = $label;
                $this->label->setInputId($this->id);
        }
        return $label;
    }

    public function getPlaceholder(){
        return $this->placeholder;
    }

    function isValid(){
        $value = $this->getValue();
        if($this->required){
            if(!isset($value)) return false;
            elseif($value==null) return false;
            elseif($value=='') return false;
        }
        return true;
    }

    function render(){
        $html = $this->renderOpenDiv();
        if(isset($this->label)){
            $html .= $this->label->render();
        }
        $html .= '<input type="email"';
        if(isset($this->id)) $html .= ' id="' . $this->id .'"';
        if(isset($this->name)) $html .= ' name="' . $this->name . '"';
        if(sizeof($this->classes)>0){
            $html .= ' class="';
            foreach($this->classes as $class){
                $html .= $class . ' ';
            }
            $html = substr($html, 0, -1);
            $html .= '"';
        }
        if(isset($this->placeholder)) $html .= ' placeholder="' . $this->placeholder . '"';
        if(isset($this->value) && $this->pre_fill) $html .= ' value="' . $this->value . '"';
        foreach($this->attributes as $attr){
            $html .= ' ' . $attr;
        }
        if(isset($this->pattern)) $html .= ' pattern="' . $this->pattern . '"';
        if(isset($this->title)) $html .= ' title="' . $this->title . '"';
        if($this->required) $html .= ' required';
        $html .= '></div>';
        return $html;
    }

}