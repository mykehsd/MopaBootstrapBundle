<?php
namespace Mopa\Bundle\BootstrapBundle\Twig\Extension;

class GlobalsExtension extends \Twig_Extension
{
    protected $globals;

    public function __construct(array $globals)
    {
        $this->globals = $globals;
    }

    /**
     * {@inheritdoc}
     */
    public function getGlobals()
    {
        return array(
            'mopa_bootstrap' => $this->globals
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'mopa_bootstrap.globals';
    }
}
