<?php
	namespace Controller\Email;
    use BerkaPhp\Controller\BerkaPhpController;
    use BerkaPhp\Helper\Auth;
    use BrkORM\T;


    class RequestController extends BerkaPhpController
	{

		function __construct() {
			parent::__construct();
		}

        /* Display all group_user_branches from database
        *  Client action in this controller
        *  @author berkaPhp
        */

		function index() {

            $branches = T::Find('branch')
                ->Join(['group_user' => 'company'],'company.GroupUserID = branch.RefGroupUserID')
                ->Join('city','city.CityID = branch.RefCityID')
                ->Join('country','country.CountryID = city.RefCountryID')
                ->Where('branch.RefGroupUserID', '=', Auth::GetActiveUser(false)->RefGroupUserID)
                ->FetchList();

            $this->view->set('branches', $branches);
			$this->view->render();

		}

        /* Add group_user_branche into database
        *  Getting data from Post
        *  @author berkaPhp
        */

		function add() {

			if($this->is_set($this->getPost())) {

                $data = \DataStamp::Create($this->getPost());

                $branch = T::Create('notification');
                $branch->SetProperties($data);

				if ($branch->Save()) {
                    return $this->jsonFormat(['success'=> true, 'message'=>Label::Success('Saving'), 'error'=>false]);
				} else {
                    return $this->jsonFormat(['error'=> true, 'message'=>Label::Error('Saving'), 'success'=>false]);
				}
			}

            $this->view->set('groupUser', T::Find('group_user')->FetchList());
            $this->view->set('language', T::Find('language')->FetchList());

            $this->view->set('country' , T::Find('country')->FetchList());
            $this->view->set('city' , T::Find('city')->FetchList());

            $this->view->render();
		}

        /* Edit group_user_branche and update the table
        *  Getting data from Post
        *  Id from params array
        *  @author berkaPhp
        */

		function edit($params) {

			$id = $params['params'];

            $branch = T::Find('branch', $id)->FetchFirstOrDefault();

			if($this->is_set($this->getPost())) {

                $data = \DataStamp::Update($this->getPost());

                if(!$branch->IsAny())
                    return $this->jsonFormat(['error'=> true, 'message'=>'branch not found', 'success'=>false]);
                $branch->SetProperties($data);

				if ($branch->Save()) {
                    return $this->jsonFormat(['success'=> true, 'message'=>Label::Success('Saving'), 'error'=>false]);
                } else {
                    return $this->jsonFormat(['error'=> true, 'message'=>Label::Error('Saving'), 'success'=>false]);
				}

			}


			$this->view->set('branch',$branch);

            $this->view->set('groupUser', T::Find('group_user')->FetchList());
            $this->view->set('language', T::Find('language')->FetchList());

            $this->view->set('country' , T::Find('country')->FetchList());
            $this->view->set('city' , T::Find('city')->FetchList());

            $this->view->render();

		}

        /* Delete group_user_branche from the table
        *  Getting group_user_branche Id from params array
        *  @author berkaPhp
        */

		function delete($params) {

			$id = $params['params'];

//			if($this->model->delete($id)) {
//				$this->view->set('message', ['success'=>'Deleted group_user_branche']);
//			} else {
//				$this->view->set('message', ['error'=>' Could not Delete group_user_branche !']);
//			}

			$this->index();

		}

        /* Viewing group_user_branche from the table
        *  Getting group_user_branche Id from params array
        *  @author berkaPhp
        */

		function view($params) {

			$id = $params['params'];

			$result = $this->model->fetchBy(['fields'=>['BranchID'=>$id]]);
			$this->view->set('group_user_branche',$result);
			$this->view->render();
		}

	}

?>