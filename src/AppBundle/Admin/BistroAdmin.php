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

class BistroAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Post')
                ->with('Main', array(
                    'class'       => 'col-md-9',
                    'box_class'   => 'box box-solid box-danger',
                    'description' => 'Lorem ipsum',
                    // ...
                ))
                    ->add('name', 'text')
                    ->add('number', 'number')
                ->end()
                ->with('Description', array('class' => 'col-md-3'))

                    ->add('description', 'textarea', array('required'=>false))
                ->end()
            ->end()
            ->tab('Test')
                ->with('Parent', array('class' => 'col-md-12'))
                    ->add('address')
                    ->add('phone')
                    ->add('workers', 'entity', array(
                                    'class' => 'AppBundle\Entity\User',
                                    'property' => 'username',
                                    'label'=>'Select Worker'
                                ))
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('number', null, array('show_filter' => true))
            ->add('description')
            ->add('address')
            ->add('phone')
            ->add('workers', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\User',
                'property' => 'username',
            ))
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
            ->addIdentifier('number')
            ->addIdentifier('description')
            ->addIdentifier('address')
            ->addIdentifier('phone')
            ->add('workers.username')
            ->add('created')
            ->add('updated')
        ;
    }

}