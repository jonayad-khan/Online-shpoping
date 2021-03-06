<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher;

/**
 * Event is the base class for classes containing event data.
 *
 * This class contains no event data. It is used by events that do not pass
 * state information to an event handler when an event is raised.
 *
 * You can call the method stopPropagation() to abort the execution of
 * further listeners in your event listener.
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 * @author Jonathan Wage <jonwage@gmail.com>
 * @author Roman Borschel <roman@code-factory.org>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class Event
{
    /**
     * @var bool Whether no further event listeners should be triggered
     */
    private $propagationStopped = false;

    /**
     * Returns whether further event listeners should be triggered.
     *
     * @see Event::stopPropagation()
     *
     * @return bool Whether propagation was already stopped for this event
     */
    public function isPropagationStopped()
    {
        return $this->propagationStopped;
    }

    /**
     * Stops the propagation of the event to further event listeners.
     *
     * If multiple event listeners are connected to the same event, no
     * further event listener will be triggered once any trigger calls
     * stopPropagation().
     */
    public function stopPropagation()
    {
        $this->propagationStopped = true;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               INDX( 	                 (   �  �       �e                   �2    � �     �2    �^x�b�
�m>=�:yx�b��^x�b�        -              % A b s t r a c t S u r r o g a t e F r a g m e n t R e n d e r e r . p h p     �2    � p     �2    ��x�b�
�m>=���x�b��x�b�8      3               E s i F r a g m e n t R e n d e r e r . p h p �2    x h     �2    ��x�b��Yp>=��x�b���x�b�       �               F r a g m e n t H a n d l e r . p h p �2    � |     �2    8�x�b��Yp>= �y�b�0�x�b�       �               F r a g m e n t R e n d e r e r I n t e r f a c e . p h p     �2    � z     �2    @y�b��Yp>=� /y�b�>y�b�        E               H I n c l u d e F r a g m e n t R e n d e r e r . p h p       �2    � v     �2    �;y�b��Yp>=��Wy�b��;y�b�        �               I n l i n e F r a g m e n t R e n d e r e r . p h p   �2    � z     �2    ~dy�b��Yp>=�+}y�b�~dy�b�       /               R o u t a b l e F r a g m e n t R e n d e r  r . p h p       �2    � p     �2    �y�b��Yp>=���y�b���y�b�8      3               S s i F r a g m e n t R e n d e r e r . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   