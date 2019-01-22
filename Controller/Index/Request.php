<?php
/**
 * Altapay Module for Magento 2.x.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2018 Altapay
 * @category  payment
 * @package   altapay
 */
namespace SDM\Altapay\Controller\Index;

use Magento\Framework\App\ResponseInterface;
use SDM\Altapay\Controller\Index;

/**
 * Class Request
 * @package SDM\Altapay\Controller\Index
 */
class Request extends Index
{

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $this->writeLog();

        if ($this->checkPost()) {
            $params = $this->gateway->createRequest(
                $this->getRequest()->getParam('paytype'),
                $this->getRequest()->getParam('orderid')
            );

            $result = new \Magento\Framework\DataObject();
            $response = $this->getResponse();
            $result->addData($params);
            return $response->representJson($result->toJson());
        }
    }
}
