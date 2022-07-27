<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('copy/custom/src/Upsert/IPRestrictionManager/Libraries/Vendor')
    ->in(__DIR__.'/src');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR2' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'array_indentation' => true,
        'phpdoc_trim' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'multiline_whitespace_before_semicolons' => false,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_leading_namespace_whitespace' => true,
        'strict_param' => true,
        'no_closing_tag' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_whitespace' => true,
        'no_whitespace_before_comma_in_array' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_empty_comment' => true,
        'php_unit_test_class_requires_covers' => true,
        'phpdoc_align' => true,
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_no_empty_return' => false,
        'multiline_whitespace_before_semicolons' => false,
        'echo_tag_syntax' => true,
        'no_unused_imports' => false,
        'not_operator_with_space' => true,
        'no_useless_else' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'length',
        ],
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_indent' => true,
        'phpdoc_no_package' => true,
        'phpdoc_order' => true,
        'phpdoc_separation' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_trim' => true,
        'phpdoc_var_without_name' => true,
        'phpdoc_to_comment' => true,
        'single_quote' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline' => true,
        'trim_array_spaces' => true,
    ])
    ->setFinder($finder);
