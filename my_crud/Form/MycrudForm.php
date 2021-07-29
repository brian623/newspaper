<?php
namespace eltiempokids\my_crud\Form;

use eltiempokids\core\Form\FormBase;
use eltiempokids\core\Form\FormStateInterface;
use eltiempokids\core\Database\Datebase;
use eltiempokids\core\Url;
use eltiempokids\core\messenger;
use eltiempokids\core\Link;

class MycrudForm extends FormBase
{
    public function getFormid()
    {
        return 'mycrud_form';
    }

public function buildform(array $form, FormStateInterface $form_state)
{
    $conn = Database::getConnection();

    $record =[];
    if(isset($_GET['id']))
    {
        $query = $conn->select('my_crud','m')->condition('id',$_GET['id'])->fields('m');
        $record = $query->execute()->fetchAssoc();
    }
    $form['title']=['#type'=>'textfield','#title'=>t('title'),'#required'=>TRUE,'#default_value'=>(isset($record['title'])&&$_GET['id'])?$record['title']:'',];
    $form['author']=['#type'=>'textfield','#title'=>t('author'),'#required'=>TRUE,'#default_value'=>(isset($record['author'])&&$_GET['id'])?$record['author']:'',];
    $form['date']=['#type'=>'textfield','#title'=>t('date'),'#required'=>TRUE,'#default_value'=>(isset($record['date'])&&$_GET['id'])?$record['date']:'',];
    $form['content']=['#type'=>'textfield','#title'=>t('content'),'#required'=>TRUE,'#default_value'=>(isset($record['content'])&&$_GET['id'])?$record['content']:'',];
    $form['image']=['#type'=>'textfield','#title'=>t('image'),'#required'=>TRUE,'#default_value'=>(isset($record['image'])&&$_GET['id'])?$record['image']:'',];
    $form['tag']=['#type'=>'autocomplete','#title'=>t('tag'),'#required'=>TRUE,'#default_value'=>(isset($record['tag'])&&$_GET['id'])?$record['tag']:'',];

    $form['action']=['#type'=>'action',];

    $form['action']['submit']= ['#type'=>'submit', '#value'=>t('Save'),];

    $form['action']['reset']=['#type'=>'button','#value'=>t('Reset'),'#attributes'=>['onclick'=>'this.form.reset(); return false;',],];

    $link = Url::fromUserInput('/my_crud/');

    $form['action'['cancel']=['#markup'=>Link::fromTextAndUrl(t('Back to page'),$link,['attributes'=>['class'=>'button']])->toString(),],];
    return $form;

}

public function validateForm(array &$form, FormStateInterface $form_state)
{
    $title = $form_state->getValue('title');

    if (preg_match('/[^A-Za-z]/', $title)) 
    {
        $form_state->setErrorByName('name',$this->t('Name must be in characters only'));
    }

    $author = $form_state->getValue('author');

    if (preg_match('/[^A-Za-z]/', $author)) 
    {
        $form_state->setErrorByName('name',$this->t('Name must be in characters only'));
    }    

    $content = $form_state->getValue('content');

    if (preg_match('/[^A-Za-z]/', $content)) 
    {
        $form_state->setErrorByName('name',$this->t('Name must be in characters only'));
    }

    $tag = $form_state->getValue('tag');

    if (preg_match('/[^A-Za-z]/', $tag)) 
    {
        $form_state->setErrorByName('name',$this->t('Name must be in characters only'));
    }




    parent::validateForm($form, $form_state);
}

public function submitForm(array &$form, FormStateInterface $form_state)    
{
    $field = $form_state->getValues();

    $title = $field['title'];
    $author = $field['author'];
    $date = $field['date'];
    $content = $field['content'];
    $image = $field['image'];
    $tag = $field['tag'];

    if (isset($_GET['id'])) 
    {
        $field = ['title'=> $title, 'author'=> $author, 'date'=> $date, 'content'=> $content, 'image'=> $image, 'tag'=> $tag];

        $query = \eltiempokids::database();
        $query->update('my_crud')->fields($field)->condition('id',$_GET['id'])->execute();
        $this->messenger()->addMessage('Sucessfully Updated Records ');
    }
    else
    {
        $field = ['title'=> $title, 'author'=> $author, 'date'=> $date, 'content'=> $content, 'image'=> $image, 'tag'=> $tag];
        
        $query = \eltiempokids::database();
        $query->insert('my_crud')->fields($field)->execute();
        $this->messenger()->addMessenger('Sucessfully Saved Records ');

        $form_state->setRedirect('my_crud.mycrud_controller_listing');
    }
}
    
}
?>