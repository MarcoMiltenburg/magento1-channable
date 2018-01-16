<?php
/**
 * Magmodules.eu - http://www.magmodules.eu
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magmodules.eu so we can send you a copy immediately.
 *
 * @category      Magmodules
 * @package       Magmodules_Channable
 * @author        Magmodules <info@magmodules.eu)
 * @copyright     Copyright (c) 2018 (http://www.magmodules.eu)
 * @license       http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 */

class Magmodules_Channable_Block_Adminhtml_System_Config_Form_Field_Feeds
    extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface
{

    /**
     * @param Varien_Data_Form_Element_Abstract $element
     *
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $helper = Mage::helper('channable');
        $storeIds = $helper->getStoreIds('channable/connect/enabled');
        $token = $helper->getToken();
        $sHtml = '';

        if ($token) {
            foreach ($storeIds as $storeId) {
                $store = Mage::getModel('core/store')->load($storeId);
                $baseUrl = $store->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);

                $url = sprintf(
                    'https://app.channable.com/connect/magento.html?store_id=%s&url=%s&token=%s',
                    $storeId,
                    $baseUrl,
                    $token
                );

                $sHtml .= sprintf(
                    '<tr><td>%s</td><td>%s</td><td><a href="%s">%s</a></td><td><a href="%s" target="_blank">%s</a></td></tr>',
                    $store->getWebsite()->getName(),
                    $store->getName(),
                    $baseUrl . 'channable/feed/get/code/' . $token . '/store/' . $storeId . '/array/1',
                    $this->__('Preview'),
                    $url,
                    $this->__('Click to auto connect with Channable')
                );
            }
        }

        if (!$sHtml) {
            $html = $helper->__('No enabled feed(s) found or token missing');
        } else {
            $html = '<div class="grid">
              <table cellpadding="0" cellspacing="0" class="border" style="width:425px;">
               <tbody>
                <tr class="headings">
                 <th>' . $helper->__('Website') .'</th>
                 <th>' . $helper->__('Store') .'</th>
                 <th>' . $helper->__('Preview') .'</th>
                 <th>' . $helper->__('Connect') .'</th>
                </tr>
               </tbody>
               ' . $sHtml . '
               </table>
              </div>';
        }

        return sprintf(
            '<tr id="row_%s"><td colspan="6" class="label" style="margin-bottom: 10px;">%s</td></tr>',
            $element->getHtmlId(), $html
        );
    }

}