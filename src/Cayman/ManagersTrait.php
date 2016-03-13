<?php

/**
 * File for managers trait
 */

namespace Cayman;

/**
 * Trait for Managers
 *
 */
trait ManagersTrait
{
    /**
     * Asset manager object
     * @var AssetManager
     */
    private $assetManager;
    
    /**
     * Set asset manager
     * @param AssetManager $assetManager
     * @return void
     */
    function setAssetManager(AssetManager $assetManager)
    {
        $this->assetManager = $assetManager;
    }
    
    /**
     * Get asset manager
     * @return AssetManager
     */
    function getAssetManager()
    {
        if (empty($this->assetManager)) {
            throw new Exception('Asset manager undefined');
        }
        
        return $this->assetManager;
    }
    
    /**
     * Cache manager object
     * @var CacheManager
     */
    private $cacheManager;
    
    /**
     * Set cache manager
     * @param CacheManager $cacheManager
     * @return void
     */
    function setCacheManager(CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }
    
    /**
     * Get cache manager
     * @return CacheManager
     */
    function getCacheManager()
    {
        if (empty($this->cacheManager)) {
            throw new Exception('Cache manager undefined');
        }
        
        return $this->cacheManager;
    }
    
    /**
     * Database manager object
     * @var DbManager
     */
    private $dbManager;
    
    /**
     * Set database manager
     * @param DbManager $dbManager
     * @return void
     */
    function setDbManager(DbManager $dbManager)
    {
        $this->dbManager = $dbManager;
    }
    
    /**
     * Get database manager
     * @return DbManager
     */
    function getDbManager()
    {
        if (empty($this->dbManager)) {
            throw new Exception('Database manager undefined');
        }
        
        return $this->dbManager;
    }
    
    /**
     * Database schema manager object
     * @var DbSchemaManager
     */
    private $dbSchemaManager;
    
    /**
     * Set database schema manager
     * @param DbSchemaManager $dbSchemaManager
     * @return void
     */
    function setDbSchemaManager(DbSchemaManager $dbSchemaManager)
    {
        $this->dbSchemaManager = $dbSchemaManager;
    }
    
    /**
     * Get database schema manager
     * @return DbSchemaManager
     */
    function getDbSchemaManager()
    {
        if (empty($this->dbSchemaManager)) {
            throw new Exception('Database schema manager undefined');
        }
        
        return $this->dbSchemaManager;
    }
    
    /**
     * Email Manager object
     * @var EmailManager
     */
    private $emailManager;
    
    /**
     * Set Email Manager
     * @param EmailManager $emailManager
     * @return void
     */
    function setEmailManager(EmailManager $emailManager)
    {
        $this->emailManager = $emailManager;
    }
    
    /**
     * Get Email Manager
     * @return EmailManager
     */
    function getEmailManager()
    {
        if (empty($this->emailManager)) {
            throw new Exception('Email manager undefined');
        }
        
        return $this->emailManager;
    }
    
    /**
     * Entity Manager object
     * @var EntityManager
     */
    private $entityManager;
    
    /**
     * Set Entity Manager
     * @param EntityManager $entityManager
     * @return void
     */
    function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * Get Entity Manager
     * @return EntityManager
     */
    function getEntityManager()
    {
        if (empty($this->entityManager)) {
            throw new Exception('Entity manager undefined');
        }
        
        return $this->entityManager;
    }
    
    /**
     * Event Manager object
     * @var EventManager
     */
    private $eventManager;
    
    /**
     * Set Event Manager
     * @param EventManager $eventManager
     * @return void
     */
    function setEventManager(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }
    
    /**
     * Get Event Manager
     * @return EventManager
     */
    function getEventManager()
    {
        if (empty($this->eventManager)) {
            throw new Exception('Event manager undefined');
        }
        
        return $this->eventManager;
    }
    
    /**
     * Filter Manager object
     * @var FilterManager
     */
    private $filterManager;
    
    /**
     * Set Filter Manager
     * @param FilterManager $filterManager
     * @return void
     */
    function setFilterManager(FilterManager $filterManager)
    {
        $this->filterManager = $filterManager;
    }
    
    /**
     * Get Filter Manager
     * @return FilterManager
     */
    function getFilterManager()
    {
        if (empty($this->filterManager)) {
            throw new Exception('Filter manager undefined');
        }
        
        return $this->filterManager;
    }
    
    /**
     * Identity Manager object
     * @var IdentityManager
     */
    private $identityManager;
    
    /**
     * Set Identity Manager
     * @param IdentityManager $identityManager
     * @return void
     */
    function setIdentityManager(IdentityManager $identityManager)
    {
        $this->identityManager = $identityManager;
    }
    
    /**
     * Get Identity Manager
     * @return IdentityManager
     */
    function getIdentityManager()
    {
        if (empty($this->identityManager)) {
            throw new Exception('Identity manager undefined');
        }
        
        return $this->identityManager;
    }
    
    /**
     * Locale Manager object
     * @var LocaleManager
     */
    private $localeManager;
    
    /**
     * Set Locale Manager
     * @param LocaleManager $localeManager
     * @return void
     */
    function setLocaleManager(LocaleManager $localeManager)
    {
        $this->localeManager = $localeManager;
    }
    
    /**
     * Get Locale Manager
     * @return LocaleManager
     */
    function getLocaleManager()
    {
        if (empty($this->localeManager)) {
            throw new Exception('Locale manager undefined');
        }
        
        return $this->localeManager;
    }
    
    /**
     * Log Manager object
     * @var LogManager
     */
    private $logManager;
    
    /**
     * Set Log Manager
     * @param LogManager $logManager
     * @return void
     */
    function setLogManager(LogManager $logManager)
    {
        $this->logManager = $logManager;
    }
    
    /**
     * Get Log Manager
     * @return LogManager
     */
    function getLogManager()
    {
        if (empty($this->logManager)) {
            throw new Exception('Log manager undefined');
        }
        
        return $this->logManager;
    }
    
    /**
     * Queue Manager object
     * @var QueueManager
     */
    private $queueManager;
    
    /**
     * Set Queue Manager
     * @param QueueManager $queueManager
     * @return void
     */
    function setQueueManager(QueueManager $queueManager)
    {
        $this->queueManager = $queueManager;
    }
    
    /**
     * Get Queue Manager
     * @return QueueManager
     */
    function getQueueManager()
    {
        if (empty($this->queueManager)) {
            throw new Exception('Queue manager undefined');
        }
        
        return $this->queueManager;
    }
    
    /**
     * Release Manager object
     * @var ReleaseManager
     */
    private $releaseManager;
    
    /**
     * Set Release
     * @param ReleaseManager $releaseManager
     * @return void
     */
    function setReleaseManager(ReleaseManager $releaseManager)
    {
        $this->releaseManager = $releaseManager;
    }
    
    /**
     * Get Release Manager
     * @return ReleaseManager
     */
    function getReleaseManager()
    {
        if (empty($this->releaseManager)) {
            throw new Exception('Release manager undefined');
        }
        
        return $this->releaseManager;
    }
    
}
