<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prophecy\Exception\Prediction;

use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Exception\Prophecy\MethodProphecyException;

class UnexpectedCallsException extends MethodProphecyException implements PredictionException
{
    private $calls = array();

    public function __construct($message, MethodProphecy $methodProphecy, array $calls)
    {
        parent::__construct($message, $methodProphecy);

        $this->calls = $calls;
    }

    public function getCalls()
    {
        return $this->calls;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Util;

/**
 * Utility class for textual type (and value) representation.
 */
class Type
{
    /**
     * @param string $type
     *
     * @return bool
     */
    public static function isType($type)
    {
        return \in_array(
            $type,
            [
                'numeric',
                'integer',
                'int',
                'float',
                'string',
                'boolean',
                'bool',
                'null',
                'array',
                'object',
                'resource',
                'scalar'
            ]
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\CodeCleaner;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use Psy\Exception\FatalErrorException;

/**
 * Validate that the user did not use the call-time pass-by-reference that causes a fatal error.
 *
 * As of PHP 5.4.0, call-time pass-by-reference was removed, so using it will raise a fatal error.
 *
 * @author Martin Hasoň <martin.hason@gmail.com>
 */
class CallTimePassByReferencePass extends CodeCleanerPass
{
    const EXCEPTION_MESSAGE = 'Call-time pass-by-reference has been removed';

    /**
     * Validate of use call-time pass-by-reference.
     *
     * @throws RuntimeException if the user used call-time pass-by-reference in PHP >= 5.4.0
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if (version_compare(PHP_VERSION, '5.4', '<')) {
            return;
        }

        if (!$node instanceof FuncCall && !$node instanceof MethodCall && !$node instanceof StaticCall) {
            return;
        }

        foreach ($node->args as $arg) {
            if ($arg->byRef) {
                throw new FatalErrorException(self::EXCEPTION_MESSAGE, 0, E_ERROR, null, $node->getLine());
            }
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             INDX( 	                 (   h  �                             �-    p \     �-    0አb�v�h=�����b�(አb�       �
               B l a c k l i s t . p h p     �-    x b     �-    ��b�v�h=�0��b���b�       f	               C o d e E x p o r t e r . p h p       �-    h V     �-    ܁��b��>h=���b�܁��b�                       
 e x c e p t i o n s   �-    p Z     �-    k+��b�v�h=��G��b�j+��b�        "               R e s t o r e r . p h p      �-    p Z     �-    zT��b�v�h=�,q��b�xT��b� 0      �!               S n a p s h o t . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              Код одно гринспана руководишь на. Его вы знания движение. Ты две начать
одиночку, сказать основатель удовольствием но миф. Бы какие система тем.
Полностью использует три мы, человек клоунов те нас, бы давать творческую
эзотерическая шеф.

Мог не помнить никакого сэкономленного, две либо какие пишите бы. Должен
компанию кто те, этот заключалась проектировщик не ты. Глупые периоды ты
для. Вам который хороший он. Те любых кремния концентрируются мог,
собирать принадлежите без вы.

Джоэла меньше хорошего вы миф, за тем году разработки. Даже управляющим
руководители был не. Три коде выпускать заботиться ну. То его система
удовольствием безостановочно, или ты главной процессорах. Мы без джоэл
знания получат, статьи остальные мы ещё.

Них русском касается поскольку по, образование должником
систематизированный ну мои. Прийти кандидата университет но нас, для бы
должны никакого, биг многие причин интервьюирования за.

Тем до плиту почему. Вот учёт такие одного бы, об биг разным внешних
промежуток. Вас до какому возможностей безответственный, были погодите бы
его, по них глупые долгий количества.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     /*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#ifdef ZTS
#include "TSRM.h"
#endif
#include "php_ini.h"
#include "ext/standard/info.h"
#include "php_symfony_debug.h"
#include "ext/standard/php_rand.h"
#include "ext/standard/php_lcg.h"
#include "ext/spl/php_spl.h"
#include "Zend/zend_gc.h"
#include "Zend/zend_builtin_functions.h"
#include "Zend/zend_extensions.h" /* for ZEND_EXTENSION_API_NO */
#include "ext/standard/php_array.h"
#include "Zend/zend_interfaces.h"
#include "SAPI.h"

#define IS_PHP_53 ZEND_EXTENSION_API_NO == 220090626

ZEND_DECLARE_MODULE_GLOBALS(symfony_debug)

ZEND_BEGIN_ARG_INFO_EX(symfony_zval_arginfo, 0, 0, 2)
	ZEND_ARG_INFO(0, key)
	ZEND_ARG_ARRAY_INFO(0, array, 0)
	ZEND_ARG_INFO(0, options)
ZEND_END_ARG_INFO()

const zend_function_entry symfony_debug_functions[] = {
	PHP_FE(symfony_zval_info,	symfony_zval_arginfo)
	PHP_FE(symfony_debug_backtrace, NULL)
	PHP_FE_END
};

PHP_FUNCTION(symfony_debug_backtrace)
{
	if (zend_parse_parameters_none() == FAILURE) {
		return;
	}
#if IS_PHP_53
	zend_fetch_debug_backtrace(return_value, 1, 0 TSRMLS_CC);
#else
	zend_fetch_debug_backtrace(return_value, 1, 0, 0 TSRMLS_CC);
#endif

	if (!SYMFONY_DEBUG_G(debug_bt)) {
		return;
	}

	php_array_merge(Z_ARRVAL_P(return_value), Z_ARRVAL_P(SYMFONY_DEBUG_G(debug_bt)), 0 TSRMLS_CC);
}

PHP_FUNCTION(symfony_zval_info)
{
	zval *key = NULL, *arg = NULL;
	zval **data = NULL;
	HashTable *array = NULL;
	long options = 0;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "zh|l", &key, &array, &options) == FAILURE) {
		return;
	}

	switch (Z_TYPE_P(key)) {
		case IS_STRING:
			if (zend_symtable_find(array, Z_STRVAL_P(key), Z_STRLEN_P(key) + 1, (void **)&data) == FAILURE) {
				return;
			}
		break;
		case IS_LONG:
			if (zend_hash_index_find(array, Z_LVAL_P(key), (void **)&data)) {
				return;
			}
		break;
	}

	arg = *data;

	array_init(return_value);

	add_assoc_string(return_value, "type", (char *)_symfony_debug_zval_type(arg), 1);
	add_assoc_stringl(return_value, "zval_hash", _symfony_debug_memory_address_hash((void *)arg TSRMLS_CC), 16, 0);
	add_assoc_long(return_value, "zval_refcount", Z_REFCOUNT_P(arg));
	add_assoc_bool(return_value, "zval_isref", (zend_bool)Z_ISREF_P(arg));

	if (Z_TYPE_P(arg) == IS_OBJECT) {
		char hash[33] = {0};

		php_spl_object_hash(arg, (char *)hash TSRMLS_CC);
		add_assoc_stringl(return_value, "object_class", (char *)Z_OBJCE_P(arg)->name, Z_OBJCE_P(arg)->name_length, 1);
		add_assoc_long(return_value, "object_refcount", EG(objects_store).object_buckets[Z_OBJ_HANDLE_P(arg)].bucket.obj.refcount);
		add_assoc_string(return_value, "object_hash", hash, 1);
		add_assoc_long(return_value, "object_handle", Z_OBJ_HANDLE_P(arg));
	} else if (Z_TYPE_P(arg) == IS_ARRAY) {
		add_assoc_long(return_value, "array_count", zend_hash_num_elements(Z_ARRVAL_P(arg)));
	} else if(Z_TYPE_P(arg) == IS_RESOURCE) {
		add_assoc_long(return_value, "resource_handle", Z_LVAL_P(arg));
		add_assoc_string(return_value, "resource_type", (char *)_symfony_debug_get_resource_type(Z_LVAL_P(arg) TSRMLS_CC), 1);
		add_assoc_long(return_value, "resource_refcount", _symfony_debug_get_resource_refcount(Z_LVAL_P(arg) TSRMLS_CC));
	} else if (Z_TYPE_P(arg) == IS_STRING) {
		add_assoc_long(return_value, "strlen", Z_STRLEN_P(arg));
	}
}

void symfony_debug_error_cb(int type, const char *error_filename, const uint error_lineno, const char *format, va_list args)
{
	TSRMLS_FETCH();
	zval *retval;

	switch (type) {
		case E_ERROR:
		case E_PARSE:
		case E_CORE_ERROR:
		case E_CORE_WARNING:
		case E_COMPILE_ERROR:
		case E_COMPILE_WARNING:
			ALLOC_INIT_ZVAL(retval);
#if IS_PHP_53
			zend_fetch_debug_backtrace(retval, 1, 0 TSRMLS_CC);
#else
			zend_fetch_debug_backtrace(retval, 1, 0, 0 TSRMLS_CC);
#endif
			SYMFONY_DEBUG_G(debug_bt) = retval;
	}

	SYMFONY_DEBUG_G(old_error_cb)(type, error_filename, error_lineno, format, args);
}

static const char* _symfony_debug_get_resource_type(long rsid TSRMLS_DC)
{
	const char *res_type;
	res_type = zend_rsrc_list_get_rsrc_type(rsid TSRMLS_CC);

	if (!res_type) {
		return "Unknown";
	}

	return res_type;
}

static int _symfony_debug_get_resource_refcount(long rsid TSRMLS_DC)
{
	zend_rsrc_list_entry *le;

	if (zend_hash_index_find(&EG(regular_list), rsid, (void **) &le)==SUCCESS) {
		return le->refcount;
	}

	return 0;
}

static char *_symfony_debug_memory_address_hash(void *address TSRMLS_DC)
{
	char *result = NULL;
	intptr_t address_rand;

	if (!SYMFONY_DEBUG_G(req_rand_init)) {
		if (!BG(mt_rand_is_seeded)) {
			php_mt_srand(GENERATE_SEED() TSRMLS_CC);
		}
		SYMFONY_DEBUG_G(req_rand_init) = (intptr_t)php_mt_rand(TSRMLS_C);
	}

	address_rand = (intptr_t)address ^ SYMFONY_DEBUG_G(req_rand_init);

	spprintf(&result, 17, "%016zx", address_rand);

	return result;
}

static const char *_symfony_debug_zval_type(zval *zv)
{
	switch (Z_TYPE_P(zv)) {
		case IS_NULL:
			return "NULL";
			break;

		case IS_BOOL:
			return "boolean";
			break;

		case IS_LONG:
			return "integer";
			break;

		case IS_DOUBLE:
			return "double";
			break;

		case IS_STRING:
			return "string";
			break;

		case IS_ARRAY:
			return "array";
			break;

		case IS_OBJECT:
			return "object";

		case IS_RESOURCE:
			return "resource";

		default:
			return "unknown type";
	}
}

zend_module_entry symfony_debug_module_entry = {
	STANDARD_MODULE_HEADER,
	"symfony_debug",
	symfony_debug_functions,
	PHP_MINIT(symfony_debug),
	PHP_MSHUTDOWN(symfony_debug),
	PHP_RINIT(symfony_debug),
	PHP_RSHUTDOWN(symfony_debug),
	PHP_MINFO(symfony_debug),
	PHP_SYMFONY_DEBUG_VERSION,
	PHP_MODULE_GLOBALS(symfony_debug),
	PHP_GINIT(symfony_debug),
	PHP_GSHUTDOWN(symfony_debug),
	NULL,
	STANDARD_MODULE_PROPERTIES_EX
};

#ifdef COMPILE_DL_SYMFONY_DEBUG
ZEND_GET_MODULE(symfony_debug)
#endif

PHP_GINIT_FUNCTION(symfony_debug)
{
	memset(symfony_debug_globals, 0 , sizeof(*symfony_debug_globals));
}

PHP_GSHUTDOWN_FUNCTION(symfony_debug)
{

}

PHP_MINIT_FUNCTION(symfony_debug)
{
	SYMFONY_DEBUG_G(old_error_cb) = zend_error_cb;
	zend_error_cb                 = symfony_debug_error_cb;

	return SUCCESS;
}

PHP_MSHUTDOWN_FUNCTION(symfony_debug)
{
	zend_error_cb = SYMFONY_DEBUG_G(old_error_cb);

	return SUCCESS;
}

PHP_RINIT_FUNCTION(symfony_debug)
{
	return SUCCESS;
}

PHP_RSHUTDOWN_FUNCTION(symfony_debug)
{
	return SUCCESS;
}

PHP_MINFO_FUNCTION(symfony_debug)
{
	php_info_print_table_start();
	php_info_print_table_header(2, "Symfony Debug support", "enabled");
	php_info_print_table_header(2, "Symfony Debug version", PHP_SYMFONY_DEBUG_VERSION);
	php_info_print_table_end();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Dumper;

use Symfony\Component\Translation\MessageCatalogue;

/**
 * PhpFileDumper generates PHP files from a message catalogue.
 *
 * @author Michel Salib <michelsalib@hotmail.com>
 */
class PhpFileDumper extends FileDumper
{
    /**
     * {@inheritdoc}
     */
    public function formatCatalogue(MessageCatalogue $messages, $domain, array $options = array())
    {
        return "<?php\n\nreturn ".var_export($messages->all($domain), true).";\n";
    }

    /**
     * {@inheritdoc}
     */
    protected function getExtension()
    {
        return 'php';
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  