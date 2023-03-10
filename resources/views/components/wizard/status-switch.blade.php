<div>
    <style>
        :root{
            --system_primary_color: #7f58fe;
        }
        
/* custom swtich */
.hrm_switch_btn {
    position: absolute;
    opacity: 0;
}

/* Normal Track */
.hrm_switch_btn.ios-switch+div {
    vertical-align: middle;
    width: 40px;
    height: 20px;
    border: 1px solid rgba(0, 0, 0, .4);
    border-radius: 999px;
    background-color: rgba(0, 0, 0, 0.1);
    -webkit-transition-duration: .4s;
    -webkit-transition-property: background-color, box-shadow;
    box-shadow: inset 0 0 0 0px rgba(0, 0, 0, 0.4);
    margin: 15px 1.2em 15px 2.5em;
}

/* Checked Track (Blue) */
.hrm_switch_btn.ios-switch:checked+div {
    width: 40px;
    background-position: 0 0;
    background-color: var(--system_primary_color);
    border: 1px solid var(--system_primary_color);
    /* box-shadow: inset 0 0 0 10px rgba(59,137,259,1); */
    box-shadow: inset var(--system_primary_color);
}

/* Tiny Track */
.hrm_switch_btn.tinyswitch.ios-switch+div {
    width: 34px;
    height: 18px;
}

/* Big Track */
.hrm_switch_btn.bigswitch.ios-switch+div {
    width: 50px;
    height: 25px;
}

/* Green Track */
.hrm_switch_btn.green.ios-switch:checked+div {
    background-color: #00e359;
    border: 1px solid rgba(0, 162, 63, 1);
    box-shadow: inset 0 0 0 10px rgba(0, 227, 89, 1);
}

/* Normal Knob */
.hrm_switch_btn.ios-switch+div>div {
    float: left;
    width: 18px;
    height: 18px;
    border-radius: inherit;
    background: #ffffff;
    -webkit-transition-timing-function: cubic-bezier(.54, 1.85, .5, 1);
    -webkit-transition-duration: 0.4s;
    -webkit-transition-property: transform, background-color, box-shadow;
    -moz-transition-timing-function: cubic-bezier(.54, 1.85, .5, 1);
    -moz-transition-duration: 0.4s;
    -moz-transition-property: transform, background-color;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(0, 0, 0, 0.4);
    pointer-events: none;
    margin-top: 1px;
    margin-left: 1px;
}

/* Checked Knob (Blue Style) */
.hrm_switch_btn.ios-switch:checked+div>div {
    -webkit-transform: translate3d(20px, 0, 0);
    -moz-transform: translate3d(20px, 0, 0);
    background-color: #ffffff;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172, 1);
}

/* Tiny Knob */
.hrm_switch_btn.tinyswitch.ios-switch+div>div {
    width: 16px;
    height: 16px;
    margin-top: 0px;
}

/* Checked Tiny Knob (Blue Style) */
.hrm_switch_btn.tinyswitch.ios-switch:checked+div>div {
    -webkit-transform: translate3d(16px, 0, 0);
    -moz-transform: translate3d(16px, 0, 0);
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172, 1);
}

/* Big Knob */
.hrm_switch_btn.bigswitch.ios-switch+div>div {
    width: 23px;
    height: 23px;
    margin-top: 1px;
}

/* Checked Big Knob (Blue Style) */
.hrm_switch_btn.bigswitch.ios-switch:checked+div>div {
    -webkit-transform: translate3d(25px, 0, 0);
    -moz-transform: translate3d(16px, 0, 0);
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172, 1);
}

/* Green Knob */
.hrm_switch_btn.green.ios-switch:checked+div>div {
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(0, 162, 63, 1);
}

    </style>

    {{-- <input type="checkbox" class="ios-switch tinyswitch" id="{{$id}}" name="{{$name}}" value="{{$value}}" {{$checked}}> --}}
    <label>
        <input type="checkbox" class="ios-switch tinyswitch hrm_switch_btn" id="{{ $id }}" name="{{ $name }}"
            value="{{ $value }}" data-column_name={{ $name }} data-table_name={{ $table }} data-change="{{ $change }}" {{
            $value==1 ? 'checked' : '' }} />
        <div>
            <div></div>
        </div>
    </label>
</div>
