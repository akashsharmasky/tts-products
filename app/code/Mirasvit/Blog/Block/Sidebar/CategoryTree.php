<?php

namespace Mirasvit\Blog\Block\Sidebar;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;
use Mirasvit\Blog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Mirasvit\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

class CategoryTree extends Template
{
    /**
     * @var CategoryCollectionFactory
     */
    protected $categoryCollectionFactory;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Context
     */
    protected $context;

    /**
     * @param CategoryCollectionFactory $postCollectionFactory
     * @param Registry                  $registry
     * @param Context                   $context
     * @param array                     $data
     */
    public function __construct(
        CategoryCollectionFactory $postCollectionFactory,
        Registry $registry,
        Context $context,
        array $data = []
    ) {
        $this->categoryCollectionFactory = $postCollectionFactory;
        $this->registry = $registry;
        $this->context = $context;

        parent::__construct($context, $data);
    }

    /**
     * @return \Mirasvit\Blog\Model\Category[]
     */
    public function getTree()
    {
        return $this->categoryCollectionFactory->create()
            ->addAttributeToSelect(['name', 'url_key'])
            ->addVisibilityFilter()
            ->excludeRoot()
            ->getTree();
    }
	
	 public function getPostCount($catid)
    {
		$total=0;
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
		$connection = $resource->getConnection();
		$sql = "SELECT * from `mst_blog_category_post` where category_id=".$catid;
		$result = $connection->fetchAll($sql);
		if(count($result)>0){
			$total=count($result);
		}
        return $total;
    }

    /**
     * @return \Mirasvit\Blog\Model\Category|false
     */
    public function getCurrentCategory()
    {
        return $this->registry->registry('current_blog_category');
    }

    /**
     * @param \Mirasvit\Blog\Model\Category $category
     * @return bool
     */
    public function isCurrent($category)
    {
        if ($this->getCurrentCategory() && $this->getCurrentCategory()->getId() == $category->getId()) {
            return true;
        }

        return false;
    }
}
