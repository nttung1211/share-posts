<?php

class ValidationField {
	public string $name;
	public string $regex;
	public string $error;

	public function __construct(string $name, string $regex, string $error) {
		$this->name = $name;
		$this->regex = $regex;
		$this->error = $error;
	}
}

class Validator {
	private array $data = [];
	private array $errors = [];
	protected array $fields = [];

	public function __construct(array $postData) {
		$this->setData($postData); // + trim()
	}

	public function setField(array $fields): void {
		$this->fields = $fields;
	}

	public function setData(array $data): void {
		foreach ($data as $key => $value) {
			$this->data[$key] = trim($value);
		}
	}

	public function validate (): array {
		foreach ($this->fields as $field) {
			if (!array_key_exists($field->name, $this->data)) {
				trigger_error("$field->name is not present in data");
			}
		}

		foreach ($this->fields as $field) {
			if (empty($this->data[$field->name])) {
				$this->errors[$field->name] = "$field->name cannot be empty.";
			} elseif (!empty($field->regex) && !preg_match($field->regex, $this->data[$field->name])) {
				$this->errors[$field->name] = $field->error;
			}
		}

		return [$this->data, $this->errors];
	}
}

class UserRegisterValidator extends Validator {

	public function __construct(array $postData) {
		parent::__construct($postData);
		$this->setField([
			new ValidationField(
				'username',
				'/^[A-Za-z0-9]{4,20}$/',
				'username must be 4-20 characters and alphanumeric.'
			),
			new ValidationField(
				'password',
				'/^[A-Za-z0-9]{4,20}$/',
				'username must be 4-20 characters and alphanumeric.'
			),
			new ValidationField(
				'confirmPassword',
				'',
				''
			),
			new ValidationField(
				'email',
				'/^\w{1,30}@\w{1,30}\.\w{1,30}.{1,30}$/',
				'Please enter a valid email (e.g., John@gmail.com)'
			)
		]);
	}
}

class UserLoginValidator extends Validator {

	public function __construct(array $postData) {
		parent::__construct($postData);
		$this->setField([
			new ValidationField(
				'username',
				'',
				''
			),
			new ValidationField(
				'password',
				'',
				''
			)
		]);
	}
}

class PostValidator extends Validator {

	public function __construct(array $postData) {
		parent::__construct($postData);
		$this->setField([
			new ValidationField(
				'title',
				'',
				''
			),
			new ValidationField(
				'body',
				'',
				''
			)
		]);
	}
}
