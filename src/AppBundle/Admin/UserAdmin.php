<?php
/**
 * Created by PhpStorm.
 * User: aram
 * Date: 12/29/15
 * Time: 12:13 PM
 */

namespace AppBundle\Admin;

use AppBundle\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin as Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Class UserAdmin
 * @package AppBundle\Admin
 */
class UserAdmin extends Admin
{
    protected $searchResultActions = array('edit', 'show', 'create', 'list');

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC', // sort direction
        '_sort_by' => 'id' // field name
    );
//    /**
//     * @return \Symfony\Component\Form\FormBuilder
//     */
//    public function getFormBuilder()
//    {
//        $this->formOptions['data_class'] = $this->getClass();
//
//        $options = $this->formOptions;
//        $options['validation_groups'] = "Admin";
//
//        $formBuilder = $this->getFormContractor()->getFormBuilder( $this->getUniqid(), $options);
//
//        $this->defineFormBuilder($formBuilder);
//
//        return $formBuilder;
//    }

//    public function prePersist($object)
//    {
//        parent::prePersist($object);
//
//        $object->addRole("ROLE_ADMIN");
//        $object->addRole("ROLE_SUPER_ADMIN");
//        $object->addRole("ROLE_SONATA_ADMIN");
//
//        $this->updatePassword($object);
//    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('email')
            ->add('username')
            ->add('lastName')
            ->add('firstName')
            ->add('phone')
            ->add('roles', 'doctrine_orm_string', array(), 'choice', array(
                'choices'  => array('ROLE_KITCHENER'=>'Kitchener', 'ROLE_CASHIER'=>'Cashier', 'ROLE_SUPER_ADMIN'=>'Admin')
            ))
            /*->add('createdAt', 'doctrine_orm_datetime_range', array('field_type'=>'sonata_type_datetime_range_picker', 'label' => 'Created'), null, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm:ss',
                'required' => false,
                'attr' => array('class' => 'datetimepicker')
            ))*/
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('email')
            ->add('username')
            ->add('lastName')
            ->add('firstName')
            ->add('phone')
            ->add('roles', 'choice', array(
                'choices'  => array('ROLE_KITCHENER'=>'Kitchener', 'ROLE_CASHIER'=>'Cashier', 'ROLE_SUPER_ADMIN'=>'Admin'),
                'multiple' => true
            ))
            ->add('enabled', null, array('editable'=>true))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // get container
        $container = $this->getConfigurationPool()->getContainer();

        $roles = $container->getParameter('security.role_hierarchy.roles');

        // get roles
//        $rolesChoices = $this->flattenRoles($roles);

        $formMapper
            ->add('email')
            ->add('username')
            ->add('lastName')
            ->add('firstName')
            ->add('phone')
            ->add('file', 'add_file_type', array('required' => false, 'label'=>'User image'))
            ->add('birthday', 'sonata_type_date_picker', array(
                'dp_side_by_side'       => false,
                'dp_use_current'        => false,
                'widget' => 'single_text',
                'format' => 'y-dd-MM', 'required'=>false))
            ->add('roles', 'choice', array(
                'choices'  => array('ROLE_KITCHENER'=>'Kitchener', 'ROLE_CASHIER'=>'Cashier'),
                'multiple' => true
            ))
            ->add('plainPassword', 'repeated', array('first_name' => 'password',
                'required' => false,
                'second_name' => 'confirm',
                'type' => 'password',
                'invalid_message' => 'Passwords do not match',
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password')))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('email')
            ->add('username')
            ->add('lastName')
            ->add('firstName')
            ->add('phone')
        ;
    }

    public function preUpdate($object)
    {
        parent::preUpdate($object);


        $this->updatePassword($object);
        $object->uploadFile();

    }

    public function prePersist($object)
    {
        parent::prePersist($object);

        $this->updatePassword($object);
        $object->uploadFile();

    }

//    /**
//     * @param $rolesHierarchy
//     * @return array
//     */
//    private function flattenRoles($rolesHierarchy)
//    {
//        // empty values for
//        $flatRoles = array();
//        foreach($rolesHierarchy as $key=> $roles) {
//
//            // check roles, don`t show role admin, and sonata entities hierarchies
//            if(strpos($key, 'SONATA') === false && $key != "ROLE_ADMIN"){
//                $flatRoles[$key] = $key;
//            }
//        }
//        return $flatRoles;
//    }

    /**
     * @param $object
     */
    private function updatePassword(User $object)
    {
        // get user manager
        $um = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');

        // get plain password
        $plainPassword = $object->getPlainPassword();

        if($plainPassword){
            // update user
            $um->updateUser($object, false);
        }
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function preRemove($object)
//    {
//        // get entity manager
//        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
//
//        // remove user relation
//        $em->getRepository("AppBundle:UserRelation")->removeRelationByUser($object->getId());
//
//        // remove user`s push
//        $em->getRepository("AppBundle:UserPush")->removePushByUser($object->getId());
//
//        // remove user ad location
//        $em->getRepository("AppBundle:UserAdLocation")->deleteExistLocations($object);
//
//        // remove user`s subscriber
//        $em->getRepository("LBPaymentBundle:Subscriber")->deleteSubscriberByUser($object);
//        //todo:: disconnect from paypal
//
//        // remove user`s report
//        $em->getRepository("AppBundle:Report")->removeReportByUser($object->getId());
//
//        // remove user`s notification
//        $em->getRepository("LBNotificationBundle:Notification")->removeNoteByUser($object->getId());
//
//        // remove user`s messages
//        $em->getRepository("LBMessageBundle:Message")->removeMessageByUser($object->getId());
//
//        // remove groups members by user
//        $em->getRepository("AppBundle:LBGroupMembers")->removeGroupMemberByUser($object->getId());
//
//        // remove groups members by user
//        $em->getRepository("AppBundle:LBGroupModerators")->removeGroupModeratorByUser($object->getId());
//
//        // remove comments by user
//        $em->getRepository("AppBundle:Comment")->removeCommentByUser($object->getId());
//
//        // remove user`s groups
//        $blogs = $em->getRepository("AppBundle:Blog")->findBy(array('author'=> $object->getId()));
//        if($blogs){
//            foreach($blogs as $blog){
//                $em->remove($blog);
//            }
//        }
//        // remove user`s groups
//        $groups = $em->getRepository("AppBundle:LBGroup")->findBy(array('author'=> $object->getId()));
//        if($groups){
//            foreach($groups as $group){
//                $em->remove($group);
//            }
//        }
//
//        // remove user files
//        $files = $object->getFiles();
//        if($files){
//            foreach($files as $file){
//                $em->remove($file);
//            }
//        }
//
//        // remove user interest
//        $interests = $object->getInterests();
//        if($interests){
//            foreach($interests as $interest){
//                $object->removeInterest($interest);
//            }
//        }
//    }
}