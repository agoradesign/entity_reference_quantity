<?php

namespace Drupal\entity_reference_quantity\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceLabelFormatter;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'entity_reference_quantity_label' formatter.
 *
 * @FieldFormatter(
 *   id = "entity_reference_quantity_label",
 *   label = @Translation("Label with quantity"),
 *   description = @Translation("Display the label of the referenced entities with quantity."),
 *   field_types = {
 *     "entity_reference_quantity"
 *   }
 * )
 */
class EntityReferenceQuantityLabelFormatter extends EntityReferenceLabelFormatter {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = parent::settingsForm($form, $form_state);
    $elements['quantity_output'] = array(
      '#type' => 'radios',
      '#options' => [
        'suffix' => t('After title'),
        'attribute' => t('In a data attribute'),
      ],
      '#title' => t('Output quantity'),
      '#default_value' => $this->getSetting('quantity_output'),
      '#required' => TRUE,
    );

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();

    switch ($this->getSetting('quantity_output')) {
      case 'attribute':
        $action = t('custom data-* attribute');
        break;
      case 'suffix':
        $action = t('suffix after title');
        break;
      default:
        $action = t('suffix after title');
    }
    $summary[] = t('Show quantity as @action', array('@action' => $action));

    return $summary;
  }

  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);
    $values = $items->getValue();

    foreach ($elements as $delta => $entity) {
      if (!empty($values[$delta]['quantity'])) {
        switch ($this->getSetting('quantity_output')) {
          case 'attribute':
            $elements[$delta]['#attributes']['data-quantity'] = $values[$delta]['quantity'];
            break;
          case 'suffix':
            $elements[$delta]['#suffix'] = ' (' . $values[$delta]['quantity'] . ')';
            break;
        }
      }
    }

    return $elements;
  }
}
