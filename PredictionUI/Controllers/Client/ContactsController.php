<?php
	namespace Controller\Client;
    use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BerkaPhp\Helper\Check;
    use BerkaPhp\Helper\DateTime;
    use BerkaPhp\Helper\Debug;
    use BerkaPhp\Helper\Html;
    use BrkORM\T;
    use Util\Request;

    class ContactsController extends BerkaPhpController
	{

		function __construct() {
			parent::__construct();
            $this->view->set('breadcrumb', 'Contact');
		}

		function index() {

            $contacts = T::Find('contact')
                ->Where('userId', '=', Auth::GetActiveUser(false)->id)
                ->Where('IsDeleted', '=', Check::$False)
                ->OrderBy('name','DESC')
                ->FetchList();

            $this->view->set('menuTitle', 'All');
            $this->view->set('contacts', $contacts);
            $this->view->render();
		}

        function add() {

            if(Request::IsPost()) {

                $data = Request::GetData();

                $contact = T::Find('contact')
                    ->Where('userId', '=', Auth::GetActiveUser(false)->id)
                    ->Where('cellPhone', '=', $data['cellPhone'])
                    ->Where('isDeleted', '=', Check::$False)
                    ->FetchFirstOrDefault();

                if($contact->IsAny()) {

                    $contact->SetProperties($data);
                    $contact->lastModifiedBy = Auth::GetActiveUser(false)->id;
                    $contact->lastModifiedDate = DATE_NOW;

                }
                else {

                    $contact = T::Create('contact');
                    $contact->SetProperties($data);
                    $contact->userId = Auth::GetActiveUser(false)->id;
                    $contact->createdBy = Auth::GetActiveUser(false)->id;
                    $contact->CreatedDate = DATE_NOW;

                }

                if ($contact->Save()) {
                    return $this->jsonFormat(['success'=> true, 'message'=>'Record saved', 'error'=>false, 'link'=>Html::action('/contacts?id='. $contact->contactId)]);
                } else {
                    return $this->jsonFormat(['error'=> true, 'message'=>'Record could not be saved, try again.', 'success'=>false]);
                }

            }
            else {
                return $this->jsonFormat(['error'=> true, 'message'=>'Invalid call.', 'success'=>false]);
            }

        }

        function edit($option) {

            $contact = T::Find('contact')
                ->Where('userId', '=', Auth::GetActiveUser(false)->id)
                ->Where('isDeleted', '=', Check::$False);

            if(sizeof($option['args']['params']) > 0) {
                $contact = $contact->Where('contactId', '=', $option['args']['params'][0])->FetchFirstOrDefault();
            }

            if(Request::IsPost()) {

                if(!$contact->IsAny()) {
                    return $this->jsonFormat(['error'=> true, 'message'=>'Record not found', 'success'=>false]);
                }

            }
            else {

                $this->view->set('contact', $contact);
                $content = $this->view->renderGetContent();

                return $this->jsonFormat(['error' => false, 'message' => false, 'success' => true, 'content' => $content]);
            }



        }




	}

?>