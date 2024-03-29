<?php

require_once __DIR__ . '/ServiceTestBase.php';

require_once __DIR__ . '/../../common/ResponseStyle.php';
require_once __DIR__ . '/../../common/Utils.php';

require_once __DIR__ . '/../../service/AuthService.php';
require_once __DIR__ . '/../../service/ServiceBase.php';


class AuthServiceTest extends ServiceTestBase
{
  const SERVICE_NAME = 'AuthServiceTest';

  private AuthService $auth_service;


  public function __construct()
  {
    parent::__construct();
    $this->auth_service = new AuthService();
  }


  public function get_access_token_by_email(): ResponseStyle
  {
    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      LogTypeOption::LOG,
      'Start Service.'
    ));

    $service_response = $this->auth_service->get_access_token_by_email('test@tools.ponzu0529.com', 'test_password');

    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      $service_response->result === ResponseStatusOption::SUCCESS ? LogTypeOption::LOG : LogTypeOption::ERROR,
      $service_response->response
    ));

    return new ResponseStyle(
      $service_response->result === ResponseStatusOption::SUCCESS ? ResponseStatusOption::SUCCESS : ResponseStatusOption::FAILURE
    );
  }


  public function get_access_token_by_dummy_email(): ResponseStyle
  {
    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      LogTypeOption::LOG,
      'Start Service.'
    ));

    $service_response = $this->auth_service->get_access_token_by_email('dummy@tools.ponzu0529.com', 'test_password');

    $service_test_response = Utils::compare_response_style(
      $service_response,
      new ResponseStyle(
        ResponseStatusOption::FAILURE,
        'ERROR: "dummy@tools.ponzu0529.com" is not registered.'
      )
    );

    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      $service_test_response->get_status() === ResponseStatusOption::SUCCESS ? LogTypeOption::LOG : LogTypeOption::ERROR,
      strval($service_test_response->get_data())
    ));

    return $service_test_response;
  }


  public function get_access_token_by_dummy_password(): ResponseStyle
  {
    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      LogTypeOption::LOG,
      'Start Service.'
    ));

    $service_response = $this->auth_service->get_access_token_by_email('test@tools.ponzu0529.com', 'dummy_password');

    $service_test_response = Utils::compare_response_style(
      $service_response,
      new ResponseStyle(
        ResponseStatusOption::FAILURE,
        'ERROR: Password is wrong.'
      )
    );

    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      $service_test_response->get_status() === ResponseStatusOption::SUCCESS ? LogTypeOption::LOG : LogTypeOption::ERROR,
      strval($service_test_response->get_data())
    ));

    return $service_test_response;
  }


  public function check_access_token(): ResponseStyle
  {
    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      LogTypeOption::LOG,
      'Start Service.'
    ));

    $service_response = $this->auth_service->check_access_token('test_access_token');

    $service_test_response = Utils::compare_response_style(
      $service_response,
      new ResponseStyle(
        ResponseStatusOption::SUCCESS,
        'Success Authorized.'
      )
    );

    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      $service_test_response->get_status() === ResponseStatusOption::SUCCESS ? LogTypeOption::LOG : LogTypeOption::ERROR,
      strval($service_test_response->get_data())
    ));

    return $service_test_response;
  }


  public function check_dummy_access_token(): ResponseStyle
  {
    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      LogTypeOption::LOG,
      'Start Service.'
    ));

    $service_response = $this->auth_service->check_access_token('dummy_access_token');

    $service_test_response = Utils::compare_response_style(
      $service_response,
      new ResponseStyle(
        ResponseStatusOption::FAILURE,
        'This AccessToken is not registered.'
      )
    );

    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      $service_test_response->get_status() === ResponseStatusOption::SUCCESS ? LogTypeOption::LOG : LogTypeOption::ERROR,
      strval($service_test_response->get_data())
    ));

    return $service_test_response;
  }


  public function check_old_access_token(): ResponseStyle
  {
    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      LogTypeOption::LOG,
      'Start Service.'
    ));

    $service_response = $this->auth_service->check_access_token('old_access_token');

    $service_test_response = Utils::compare_response_style(
      $service_response,
      new ResponseStyle(
        ResponseStatusOption::FAILURE,
        'This AccessToken Timeout.'
      )
    );

    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      $service_test_response->get_status() === ResponseStatusOption::SUCCESS ? LogTypeOption::LOG : LogTypeOption::ERROR,
      strval($service_test_response->get_data())
    ));

    return $service_test_response;
  }


  public function check_access_token_by_email(): ResponseStyle
  {
    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      LogTypeOption::LOG,
      'Start Service.'
    ));

    $service_response = $this->auth_service->check_access_token_by_email('access_token_test@tools.ponzu0529.com', 'test_access_token');

    $service_test_response = Utils::compare_response_style(
      $service_response,
      new ResponseStyle(
        ResponseStatusOption::SUCCESS,
        'Success Authorized.'
      )
    );

    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      $service_test_response->get_status() === ResponseStatusOption::SUCCESS ? LogTypeOption::LOG : LogTypeOption::ERROR,
      strval($service_test_response->get_data())
    ));

    return $service_test_response;
  }


  public function check_access_token_by_dummy_email(): ResponseStyle
  {
    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      LogTypeOption::LOG,
      'Start Service.'
    ));

    $service_response = $this->auth_service->check_access_token_by_email('dummy@tools.ponzu0529.com', 'test_access_token');

    $service_test_response = Utils::compare_response_style(
      $service_response,
      new ResponseStyle(
        ResponseStatusOption::FAILURE,
        'ERROR: "dummy@tools.ponzu0529.com" is not registered.'
      )
    );

    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      $service_test_response->get_status() === ResponseStatusOption::SUCCESS ? LogTypeOption::LOG : LogTypeOption::ERROR,
      strval($service_test_response->get_data())
    ));

    return $service_test_response;
  }


  public function check_dummy_access_token_by_email(): ResponseStyle
  {
    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      LogTypeOption::LOG,
      'Start Service.'
    ));

    $service_response = $this->auth_service->check_access_token_by_email('access_token_test@tools.ponzu0529.com', 'dummy_access_token');

    $service_test_response = Utils::compare_response_style(
      $service_response,
      new ResponseStyle(
        ResponseStatusOption::FAILURE,
        'ERROR: The AccessToken is unauthorized.'
      )
    );

    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      $service_test_response->get_status() === ResponseStatusOption::SUCCESS ? LogTypeOption::LOG : LogTypeOption::ERROR,
      strval($service_test_response->get_data())
    ));

    return $service_test_response;
  }


  public function check_old_access_token_by_email(): ResponseStyle
  {
    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      LogTypeOption::LOG,
      'Start Service.'
    ));

    $service_response = $this->auth_service->check_access_token_by_email('access_token_test@tools.ponzu0529.com', 'old_access_token');

    $service_test_response = Utils::compare_response_style(
      $service_response,
      new ResponseStyle(
        ResponseStatusOption::FAILURE,
        'ERROR: The AccessToken is unauthorized.'
      )
    );

    $this->logging_service->record_log(new LogStyle(
      $this::SERVICE_NAME,
      $service_test_response->get_status() === ResponseStatusOption::SUCCESS ? LogTypeOption::LOG : LogTypeOption::ERROR,
      strval($service_test_response->get_data())
    ));

    return $service_test_response;
  }
}
