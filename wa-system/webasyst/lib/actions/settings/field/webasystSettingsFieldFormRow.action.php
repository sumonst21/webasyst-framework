<?php

class webasystSettingsFieldFormRowAction extends webasystSettingsViewAction
{
    public function execute()
    {
        $f = waRequest::param('f');
        $fid = waRequest::param('fid');
        $parent = waRequest::param('parent');
        $css_class = waRequest::param('css_class');

        $new_field = false;
        if (!($f instanceof waContactField)) {
            $new_field = true;
            $f = new waContactStringField($fid, '');
        }

        $prefix = 'options';
        if ($parent) {
            $prefix .= '['.$parent.'][fields]';
        }

        $form = waContactForm::loadConfig(array(
            '_default_value' => $f,
        ), array(
            'namespace' => "{$prefix}[{$fid}]"
        ));

        $this->view->assign(array(
            'f'          => $f,
            'fid'        => $fid,
            'form'       => $form,
            'parent'     => $parent,
            'prefix'     => $prefix,
            'uniqid'     => str_replace('.', '-', 'f'.uniqid('f', true)),
            'new_field'  => $new_field,
            'tr_classes' => $css_class,
            'ftypes'     => waContactFields::getTypes(),
        ));
    }
}