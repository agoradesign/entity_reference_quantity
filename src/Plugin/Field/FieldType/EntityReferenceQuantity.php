<?php

namespace Drupal\entity_reference_quantity\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem;

/**
 * Plugin implementation of the 'entity_reference_quantity' field type.
 *
 * @FieldType(
 *   id = "entity_reference_quantity",
 *   label = @Translation("Entity reference w/quantity"),
 *   description = @Translation("Entity reference with associated quantity"),
 *   category = @Translation("Reference"),
 *   default_widget = "entity_reference_quantity_autocomplete",
 *   default_formatter = "entity_reference_quantity_label",
 *   list_class = "\Drupal\Core\Field\EntityReferenceFieldItemList" * )
 */
class EntityReferenceQuantity extends EntityReferenceItem {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = parent::propertyDefinitions($field_definition);
    $quantity_definition = DataDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('Quantity'))
      ->setRequired(TRUE);
    $properties['quantity'] = $quantity_definition;
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = parent::schema($field_definition);
    $schema['columns']['quantity'] = array(
      'type' => 'int',
      'not null' => TRUE,
      'default' => 1,
      'unsigned' => FALSE,
    );

    return $schema;
  }
}
