<?php


class myFormLanguage extends sfForm
{
  protected $culture;
  protected $cultureReplacment;

  /**
   * Constructor.
   *
   * @param array  An array of options
   * @param string A CSRF secret (false to disable CSRF protection, null to use the global CSRF secret)
   *
   * @see sfForm
   */
  public function __construct($culture, $options = array(), $CSRFSecret = null)
  {
    $this->culture=$this->cultureReplacment($culture, 'backward');
    //var_dump($culture, $this->culture);

    if (!isset($options['languages']))
    {
      throw new RuntimeException(sprintf('%s requires a "languages" option.', get_class($this)));
    }

	$formData=array('language' => $this->culture);
	if(isset($options['redirect_uri'])) $formData['redirect_uri'] = $options['redirect_uri'];
    parent::__construct($formData, $options, $CSRFSecret);
  }

  /**
   * Changes the current user culture.
   */
  public function save()
  {
    //$this->user->setCulture($this->getValue('language'));
  }

  /**
   * Processes the current request.
   *
   * @param  sfRequest A sfRequest instance
   *
   * @return Boolean   true if the form is valid, false otherwise
   */
  public function process(sfRequest $request)
  {
    $data = array('language' => $request->getParameter('language'),
    			'redirect_uri' => $request->getParameter('redirect_uri'));

    if ($request->hasParameter(self::$CSRFFieldName))
    {
      $data[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
    }

    $this->bind($data);

    if ($isValid = $this->isValid())
    {
      return $this->cultureReplacment($this->getValue('language'), 'forward');
    }

    return $isValid;
  }

  /**
   * @see sfForm
   */
  public function configure()
  {
    $this->setValidators(array(
      'language' => new sfValidatorI18nChoiceLanguage(array('languages' => $this->options['languages'])),
      'redirect_uri' => new sfValidatorString(),
    ));

    $this->setWidgets(array(
      'language' => new sfWidgetFormI18nChoiceLanguage(array('culture' => sfConfig::get('app_culture_default'), 'languages' => $this->options['languages'])),
      'redirect_uri' => new sfWidgetFormInputHidden(),
    ));

  }

  protected function cultureReplacment($culture, $direction='forward') {
  	$this->cultureReplacment = array('en_US'=>'en', 'en'=>'uk');

  	if($direction=='forward') {
  		if(isset($this->cultureReplacment[$culture])) return $this->cultureReplacment[$culture];
  	} elseif($direction=='backward') {
  		if($key=array_search($culture, $this->cultureReplacment)) return $key;
  	}

  	return $culture;
  }
}
