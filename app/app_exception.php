<?php
class AppException extends Exception
{

}

class ValidationException extends AppException
{
	
}

class RecordNotFoundException extends ValidationException
{
	
}

class UserExistsException extends ValidationException
{

}

class NotFoundException extends AppException
{
    
}