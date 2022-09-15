<div class="details">
    <span class="credit-price">
        Q<?=$quantity?> x R<?=$price->price?> = R<?=$quantity * $price->price?> <span>excl VAT</span>
    </span>
     <span class="credit-price-incl">
        R<?=(($quantity * $price->price) * 0.15) + ($quantity * $price->price)?> <span>VAT@(15%) included (R<?=(($quantity * $price->price) * 0.15)?>)</span>
    </span>
</div>