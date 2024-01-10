<div class="form1-container">
    <form wire:submit.prevent="conditionSing">
        @csrf
        <label for="">Condition:</label>
        <input type="hidden" wire:model='itemID' value="{{ $id }}">
        <select wire:model="condition">
            <option value="Good">Good</option>
            <option value="Damage">Damaged</option>
            <option value="Missing">Missing</option>
        </select>
        <button class="btn-primary btn-xs">SET</button>
    </form>
</div>
