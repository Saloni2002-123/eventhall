<?php

function getStatusColorClass($status)
{
    switch ($status) {
        case 'Pending':
            return 'pending';
        case 'Confirmed':
            return 'confirmed';
        case 'Done':
            return 'done';
        case 'Cancelled':
            return 'cancelled';
        default:
            return '';
    }
}
