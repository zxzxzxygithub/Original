<?php

namespace api\models\cart;

use Yii;
use common\models\SalesFlatCartItem;
use api\models\product\ProductInfo;
use api\models\cart\Cart;
use yii\web\HttpException;

class CartItem extends SalesFlatCartItem
{
    public static function findItemByCartIdAndProductId($cart_id, $product_id)
    {
        return static::find()
            ->where(['cart_id' => $cart_id])
            ->andWhere(['product_id' => $product_id])
            ->one();
    }

    public function saveItem($cart, $items_count)
    {
        if (! $this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]);
        }

        if ($this->save()) {
            $cart->items_count = $items_count;
            $cart->save();
        }

        return $this;
    }

    public function updateItem($items_count)
    {
        if (! $this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]);
        }

        if ($this->save()) {
            $cart = Cart::findOne($this->cart_id);
            $cart->items_count = $items_count;
            return $cart->save();
        }

        return null;
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getCart()
    {
        return $this->hasOne(Cart::className(), ['id' => 'cart_id']);
    }
}
