<?php
/**
 * Created by PhpStorm.
 * User: developer-01
 * Date: 8/25/16
 * Time: 11:29 AM
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Bistro;
use Sonata\AdminBundle\Admin\AbstractAdmin as Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Post')
                ->with('Main', array(
                    'class'       => 'col-md-12',
                    'box_class'   => 'box box-solid box-danger',
                    'description' => 'Lorem ipsum',
                    // ...
                ))
                    ->add('name', 'text')
                    ->add('exportPrice', 'number')
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('show_filter' => true))
            ->add('exportPrice', null, array('show_filter' => true))
            ->add('created')
            ->add('updated')
        ;
    }

//    public function add(
//        $name,
//
//        // filter
//        $type = null,
//        array $filterOptions = array(),
//
//        // field
//        $fieldType = null,
//        $fieldOptions = null
//    )

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('exportPrice')
            ->add('created')
            ->add('updated')
        ;
    }

}