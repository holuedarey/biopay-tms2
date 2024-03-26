<div @class(['f-w-500', 'font-secondary' => $value < 0, 'font-success' => $value >= 0])>
    <i @class(['icon-rotate me-1', 'icon-arrow-down' => $value < 0, 'icon-arrow-up' => $value >= 0])></i>
    <span>{{ $value }}%</span>
</div>