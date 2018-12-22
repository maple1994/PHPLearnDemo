<?php

/**
 * 单例工厂类
 * 通过这个工厂类，可以传递过来一个模型类的类名
 * 并返回给类的一个实例（对象），而且，保证其为“单例的”
 */
class ModelFactory {
    /// 用于存储
    static $all_model = array();

    /// model_name为一个模型的类名
    static function M($model_name) {
        if (!isset(static::$all_model[$model_name]) ||
            !(static::$all_model[$model_name] instanceof $model_name)) {
            static::$all_model[$model_name] = new $model_name();
        }
        return static::$all_model[$model_name];
    }
}