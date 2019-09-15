<?php
/**
 * Load and prepare Models.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2019
 * @license MIT
 */

namespace Laramore\Providers;

use Illuminate\Support\ServiceProvider;
use Laramore\Interfaces\IsALaramoreModel;
use Laramore\Observers\BaseManager;
use Laramore\Grammars\GrammarTypeManager;
use Laramore\Models\ModelEventManager;
use Laramore\Validations\ValidationManager;
use Laramore\Proxies\ProxyManager;
use Laramore\{
    TypeManager, Meta, MetaManager
};
use ReflectionNamespace;

class LaramoreProvider extends ServiceProvider
{
    /**
     * Grammar and Model observer managers.
     *
     * @var BaseManager
     */
    protected $grammarTypeManager;
    protected $modelEventManager;
    protected $proxyManager;

    /**
     * Type manager.
     *
     * @var TypeManager
     */
    protected $typeManager;

    /**
     * Meta manager.
     *
     * @var MetaManager
     */
    protected $metaManager;

    /**
     * Default grammar namespace.
     *
     * @var string
     */
    protected $grammarNamespace = 'Illuminate\\Database\\Schema\\Grammars';

    /**
     * Default model namespace.
     *
     * @var string
     */
    protected $modelNamespace = 'App\\Models';

    /**
     * Default types to create.
     *
     * @var array
     */
    protected $defaultTypes = [
        'boolean' => 'bool',
        'integer' => 'integer',
        'unsignedInteger' => 'integer',
        'increment' => 'integer',
        'string' => 'string',
        'text' => 'string',
        'char' => 'string',
        'datetime' => 'string',
        'timestamp' => 'integer',
    ];

    /**
     * Prepare all singletons and add booting and booted \Closures.
     *
     * @return void
     */
    public function register()
    {
        $this->createSigletons();
        $this->createObjects();

        $this->app->booting([$this, 'bootingCallback']);
        $this->app->booted([$this, 'bootedCallback']);
    }

    /**
     * Create all singletons: GrammarTypeManager, ModelEventManager, ProxyManager, TypeManager, MetaManager.
     *
     * @return void
     */
    protected function createSigletons()
    {
        $this->app->singleton('GrammarTypeManager', function() {
            return $this->grammarTypeManager;
        });

        $this->app->singleton('ModelEventManager', function() {
            return $this->modelEventManager;
        });

        $this->app->singleton('ProxyManager', function() {
            return $this->proxyManager;
        });

        $this->app->singleton('TypeManager', function() {
            return $this->typeManager;
        });

        $this->app->singleton('ValidationManager', function() {
            return $this->validationManager;
        });

        $this->app->singleton('MetaManager', function() {
            return $this->metaManager;
        });
    }

    /**
     * Create all singleton objects: GrammarTypeManager, ModelEventManager, ProxyManager, TypeManager, MetaManager.
     *
     * @return void
     */
    protected function createObjects()
    {
        $this->grammarTypeManager = new GrammarTypeManager;
        $this->modelEventManager = new ModelEventManager;
        $this->proxyManager = new ProxyManager;
        $this->typeManager = new TypeManager($this->defaultTypes);
        $this->validationManager = new ValidationManager;
        $this->metaManager = new MetaManager;
    }

    /**
     * Add all metas to the MetaManager from a specific namespace.
     *
     * @return void
     */
    protected function addMetas()
    {
        foreach ((new ReflectionNamespace($this->modelNamespace))->getClasses() as $modelClass) {
            if ($modelClass->implementsInterface(IsALaramoreModel::class)) {
                $modelClass->getName()::getMeta();
            }
        }
    }

    /**
     * Create grammar observable handlers for each possible grammars and add them to the GrammarTypeManager.
     *
     * @return void
     */
    protected function createGrammarObservers()
    {
        foreach ((new ReflectionNamespace($this->grammarNamespace))->getClassNames() as $class) {
            if ($this->grammarTypeManager->doesManage($class)) {
                $this->grammarTypeManager->createHandler($class);
            }
        }
    }

    /**
     * Prepare metas and grammar observable handlers before booting.
     *
     * @return void
     */
    public function bootingCallback()
    {
        $this->addMetas();
        $this->createGrammarObservers();
    }

    /**
     * Lock all managers after booting.
     *
     * @return void
     */
    public function bootedCallback()
    {
        $this->metaManager->lock();
        $this->typeManager->lock();
        $this->modelEventManager->lock();
        $this->proxyManager->lock();
        $this->grammarTypeManager->lock();
    }
}
