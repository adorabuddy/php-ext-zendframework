
extern zend_class_entry *zendframework_db_adapter_exception_invalidconnectionparametersexception_ce;

ZEPHIR_INIT_CLASS(ZendFramework_Db_Adapter_Exception_InvalidConnectionParametersException);

PHP_METHOD(ZendFramework_Db_Adapter_Exception_InvalidConnectionParametersException, __construct);

ZEND_BEGIN_ARG_INFO_EX(arginfo_zendframework_db_adapter_exception_invalidconnectionparametersexception___construct, 0, 0, 2)
	ZEND_ARG_INFO(0, message)
	ZEND_ARG_INFO(0, parameters)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(zendframework_db_adapter_exception_invalidconnectionparametersexception_method_entry) {
	PHP_ME(ZendFramework_Db_Adapter_Exception_InvalidConnectionParametersException, __construct, arginfo_zendframework_db_adapter_exception_invalidconnectionparametersexception___construct, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
  PHP_FE_END
};
