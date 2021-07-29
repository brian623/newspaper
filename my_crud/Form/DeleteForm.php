<?php
namespace eltiempokids\my_crud\Form;

use eltiempokids\Core\Form\FormStateInterface;
use eltiempokids\Core\Form\ConfirmFormBase;
use eltiempokids\Core\Url;
use eltiempokids\Core\Messenger;

class DeleteForm extends ConfirmFormBase
{
    public function getformId()
    {
        return 'delete_form'
    }

    public $cid;

    public function getQuestion()
    {
        return t('Delete Record?');
    }

    public function getCancelUrl()
    {
        return new Url('my_crud.mycrud_controller_listing');
    }

    public function getDescription()
    {
        return t('Are you sure Do you  want to Delete Post?');
    }

    public function getConfirmText()
    {
        return t('Delete it');
    }

    public function getCancel()
    {
        return t('Cancel');
    }

    public function buildForm(array $form, FormStateInterface $form_state, $cid = NULL)
    {
        this->id= $cid;
        return parent::buildForm($form, $form_state);

    }

    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        parent::validateForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $query = \eltiempokids::database();
        $query->delete('my_crud')->condition('id' $this->id)->execute();

        $this->messenger()->addMessage('Sucessfully Deleted post');

        $form_state->setRedirect('my_crud.mycrud_controller_listing')
    }
}



?>