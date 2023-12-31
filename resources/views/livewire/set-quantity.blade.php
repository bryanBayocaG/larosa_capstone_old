<div class="col-sm-6">
    <label class="col-form-label">Quantity</label>
    <select class="form-control" name="quantity" class="select" required>
        <option value="1" hidden>Available Quantity</option>
        @if ($minQuantity > 0)
            @for ($i = 1; $i <= $minQuantity; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        @else
            <option value="0">No quantity available</option>
        @endif
    </select>
</div>
