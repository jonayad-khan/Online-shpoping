ame();
                }
                // no line for these, but this'll do
                if ($fileName = $reflector->getDeclaringClass()->getFileName()) {
                    $vars['__file'] = $fileName;
                    $vars['__dir']  = dirname($fileName);
                }
                break;
        }

        if ($reflector instanceof \ReflectionClass || $reflector instanceof \ReflectionFunctionAbstract) {
            if ($fileName = $reflector->getFileName()) {
                $vars['__file'] = $fileName;
                $vars['__line'] = $reflector->getStartLine();
                $vars['__dir']  = dirname($fileName);
            }
        }

        $this->context->setCommandScopeVariables($vars);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  Webmozart Assert
================

[![Build Status](https://travis-ci.org/webmozart/assert.svg?branch=1.2.0)](https://travis-ci.org/webmozart/assert)
[![Build status](https://ci.appveyor.com/api/projects/status/lyg83bcsisrr94se/branch/master?svg=true)](https://ci.appveyor.com/project/webmozart/assert/branch/master)
[![Latest Stable Version](https://poser.pugx.org