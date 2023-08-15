<?php
	namespace Controller\Client;
	use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\Debug;
    use BerkaPhp\Helper\Rand;
    use BerkaPhp\Helper\SessionHelper;
    use BerkaPhp\HelperRand;
    use BerkaPhp\Helper\RedirectHelper;
    use BerkaPhp\HelperessionHelper;
    use BrkORM\T;
    use Resource\Label;
    use Util\Helper;
    use Util\Request;

    class TemplateController extends BerkaPhpController
	{

		function __construct() {
			parent::__construct();

		}

        function index($params = null) {

            $templates = @T::Find('prediction_contribution')
                ->Where('prediction_contribution.isDeleted', '=', \Helper\Check::$False);

            if(Auth::GetActiveUser(true)->role->code == 'CLT')
                $templates = $templates->Where('prediction_contribution.userId', '=', Auth::GetActiveUser(true)->id);

            $templates = $templates->FetchList();

            $this->view->set('predictionTemplates', $templates);
            $this->view->render();

        }

        function update($params = null) {

            $data = $this->getPost();
            $templateId = 0;

            if(is_array($params) && sizeof($params['args']) > 0 && sizeof($params['args']['params']) > 0)
                $templateId = $params['args']['params'][0];

            if(sizeof($data) > 0) {

                $template = @T::Find('prediction_contribution');

                if ($templateId > 0 ) {

                    $template = $template->Where('prediction_contribution.id', '=', $templateId)->Where('prediction_contribution.isDeleted', '=', \Helper\Check::$False);

                    if (Auth::GetActiveUser(true)->role->code == 'CLT')
                        $template = $template->Where('prediction_contribution.userId', '=', Auth::GetActiveUser(true)->id);

                    $template = $template->FetchFirstOrDefault();

                    if (!$template->IsAny())
                        return $this->jsonFormat(['success' => false, 'error' => true, 'message' => "No template found to update"]);

                    $template->modifiedDate = DATE_NOW;
                    $template->modifiedBy = Auth::GetActiveUser(true)->username;
                }
                else {
                    $template->createdDate = DATE_NOW;
                    $template->createdBy = Auth::GetActiveUser(true)->username;
                }

                $template->SetProperties($data);

                if (empty($template->name) || empty($template->description) )
                    return $this->jsonFormat(['success' => false, 'error' => true, 'message' => "Template name or description can not be empty "]);

                $template->userId = Auth::GetActiveUser(true)->id;

                if($template->Save())
                    return $this->jsonFormat(['success'=>true,'error'=> false, 'message'=> "Your template has been successfully saved.", 'link'=>'/template/update/'.$template->id]);
                else
                    return $this->jsonFormat(['success'=>false,'error'=> true, 'message'=> "Your template couldn't be saved, try again"]);

            } else {

                $template = @T::Find('prediction_contribution');

                if ($templateId > 0 ) {

                    $template = $template->Where('prediction_contribution.id', '=', $templateId);

                    if (Auth::GetActiveUser(true)->role->code == 'CLT')
                        $template = $template->Where('prediction_contribution.userId', '=', Auth::GetActiveUser(true)->id);

                    $template = $template->Where('prediction_contribution.isDeleted', '=', \Helper\Check::$False);
                    $template = $template->FetchFirstOrDefault();
                }

                if (!$template->IsAny()) {

                    $template = @T::Find('prediction_contribution')
                        ->Where('prediction_contribution.code', '=', 'DFT')
                        ->Where('prediction_contribution.isDeleted', '=', \Helper\Check::$False)
                        ->FetchFirstOrDefault();

                    $template->id = '';
                    $template->name = '';
                    $template->description = '';
                }

                $leagues = @T::Find('league')
                    ->Where('league.isDeleted', '=', \Helper\Check::$False)
                    ->FetchList();

                $this->view->set('leagues', $leagues);
                $this->view->set('pTemplate', $template);
                $this->view->render();
            }

        }

	}

?>