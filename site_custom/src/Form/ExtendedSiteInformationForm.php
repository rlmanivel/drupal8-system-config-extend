<?php

namespace Drupal\site_custom\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;


class ExtendedSiteInformationForm extends SiteInformationForm {
 
   /**
   * {@inheritdoc}
   */
	  public function buildForm(array $form, FormStateInterface $form_state) {
		// Retrieve the system.site configuration
		$site_config = $this->config('system.site');

		// Get the original form from the class we are extending
		$form =  parent::buildForm($form, $form_state);

		// Add Text field to the site information section of the form
		$form['site_information']['siteapikey'] = [
			'#type' => 'textfield',
			'#title' => t('Site API Key'),
			'#default_value' => $site_config->get('siteapikey') ?: 'No API Key yet',
			'#description' => t("Custom field to set the Site API Key"),
		];
		return $form;
	 }
	
	  public function submitForm(array &$form, FormStateInterface $form_state) {
		// Now we need to save the new site api key to the
		// system.site.siteapikey configuration.
		$this->config('system.site')
			// The siteapikey is retrieved from the submitted form values
			// and saved to the 'siteapikey' element of the system.site configuration
		  ->set('siteapikey', $form_state->getValue('siteapikey'))
		  ->save();

		// Pass the remaining values off to the original form that we have extended,
		// so that they are also saved
		parent::submitForm($form, $form_state);
	  }
}