<style>
    ol.progtrckr {
        margin: 10px 0;
        padding: 2em 0 0 0;
        list-style-type: none;
        display: flex;
        justify-content: space-between;
    }
    
    ol.progtrckr li {
        list-style: none;
        text-align: center;
        flex: 1;
        line-height: 4em;
        font-size: 12px;
    }
    
    ol.progtrckr li.progtrckr-done {
        color: black;
        border-top: 4px solid yellowgreen;
    }
    
    ol.progtrckr li.progtrckr-todo {
        color: silver;
        border-top: 4px solid silver;
    }
    
    ol.progtrckr li.progtrckr-cancelled,
    ol.progtrckr li.progtrckr-pending-payment {
        color: tomato;
        border-top: 4px solid tomato;
    }
    
    ol.progtrckr li:after {
        content: "\00a0\00a0";
    }
    
    ol.progtrckr li:before {
        position: relative;
        top: -1.4em;
        float: left;
        left: 50%;
        line-height: 1em;
    }
    
    ol.progtrckr li.progtrckr-done:before {
        content: "\2713";
        color: white;
        background-color: yellowgreen;
        height: 2.2em;
        width: 2.2em;
        line-height: 2.2em;
        border: none;
        border-radius: 2.2em;
    }
    
    ol.progtrckr li.progtrckr-todo:before {
        content: "\039F";
        color: white;
        background-color: silver;
        height: 2.2em;
        width: 2.2em;
        line-height: 2.2em;
        border: none;
        border-radius: 2.2em;
    }
    
    ol.progtrckr li.progtrckr-cancelled:before,
    ol.progtrckr li.progtrckr-pending-payment:before {
        content: "\2713";
        color: white;
        background-color: tomato;
        height: 2.2em;
        width: 2.2em;
        line-height: 2.2em;
        border: none;
        border-radius: 2.2em;
    }
    
</style>

@php
switch ($status) {
    case "cancelled":
        $stage = 0;
        break;
    case "pending_payment":
        $stage = 1;
        break;
    case("pending"):
        $stage = 2;
        break;
    case "confirmed":
        $stage = 3;
        break;
    case "processing":
        $stage = 4;
        break;
    case "shipped":
        $stage = 5;
        break;
    case "delivered":
        $stage = 6;
        break;
    default:
        $stage = -1;
}
@endphp

<ol class="progtrckr">
    @if($status == "cancelled")
    <li class="{{ $stage == 0 ? 'progtrckr-cancelled' : 'progtrckr-done' }}">Cancelled</li>
    @endif
    <li class="{{ $stage >= 2 ? 'progtrckr-done' : 'progtrckr-todo' }}">Pending</li>
    <li class="{{ $stage >= 3 ? 'progtrckr-done' : 'progtrckr-todo' }}">Confirmed</li>
    <li class="{{ $stage >= 4 ? 'progtrckr-done' : 'progtrckr-todo' }}">Processing</li>
    <li class="{{ $stage >= 5 ? 'progtrckr-done' : 'progtrckr-todo' }}">Shipped</li>
    <li class="{{ $stage >= 6 ? 'progtrckr-done' : 'progtrckr-todo' }}">Delivered</li>
</ol>
