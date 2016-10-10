<?php

class Fairypass_AddrecipeController extends Fairypass_Controller_Action
{

	public function init()
	{

	}

    public function indexAction()
    {
    	$this->prepareSearchFields();
    	
    	if ($_COOKIE['isunderage'])
    	{
    		$this->view->isUnderage = true;
    	}
    	
    	$user = $this->getUser();
    	if (!$user->isFormRegistered())
    	{
    		$this->_helper->redirector('index', 'form', 'fairypass', array('lang' => $this->view->localLang));
    	}
    }
    
    public function saveAction()
    {
    	if ($this->hasParam('recipe_name'))
    	{
    		$tRecipe = new Application_Model_DbTable_Recipe();
    		 
    		$recipe = $tRecipe->createRecipe($this->getUser(), $this->view->localFullLang);
    		 
    		// picture
    		$picture = $this->savePhoto('photo');
    		if (!empty($picture))
    		{
    			$recipe->photo_path = $picture;
    		}
    		 
    		$recipe->prepare_time_id = $this->getParam('preparation_time');
    		$recipe->cook_time_id = $this->getParam('cooking_time');
    		$recipe->serving_id = $this->getParam('serving');
    		$recipe->category_id = $this->getParam('recipe_category');
    		$recipe->occasion_id = $this->getParam('recipe_occasion');
    		$recipe->ease_id = $this->getParam('recipe_ease');
    		 
    		$recipe->ingredient = $this->getParam('recipe_ingredients');
    		$recipe->description = $this->getParam('recipe_description');
    		$recipe->name = $this->getParam('recipe_name');
    		$recipe->lead = $this->getParam('recipe_lead');
    		$recipe->save();
    		 
    		$user = $this->getUser();
    		if (!$user->isFormRegistered())
    		{
    			$this->_helper->redirector('index', 'form', 'fairypass', array('lang' => $this->view->localLang));
    		} else {
    			$this->view->recipeAdded = true;
    			$this->_forward('index');
    		}
    	} else {
    		$this->_forward('index');
    	}
    	
    	
    	
    }

}
