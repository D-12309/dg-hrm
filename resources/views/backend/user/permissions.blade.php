<tbody>
    @foreach($data['permissions'] as $parent_key => $permission)
    @php
        $permission_exists=count(array_intersect(array_values($permission->keywords),$data['role_permissions']));
    @endphp
        <tr>
            <td colspan="2">
                <div class="row">
                    <div class="col-md-12" >
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="" class="custom-control-input read common-key module_all_check" {{ $permission_exists > 0 ? 'checked':'' }} data-id="{{ $parent_key }}" data-target_div="module_permissions{{ $parent_key }}" id="module{{ $parent_key }}">
                            <label class="custom-control-label ml-20 w-100 "  for="module{{ $parent_key }}">
                                <a class="btn btn-primary text-left" style="width: 100%"  data-toggle="collapse" href="#permission_section{{ $parent_key }}" role="button" aria-expanded="false" aria-controls="permission_section{{ $parent_key }}">
                                    <span class="text-capitalize">{{plain_text($permission->attribute)}}</span>
                                </a>
                            </label>
                        </div>
                    </div>
                </div>
                  <div class="collapse mt-2" id="permission_section{{ $parent_key }}">
                    <div class="card card-body">
                        <div class="row" id="module_permissions{{ $parent_key }}">
                            @foreach($permission->keywords as $key=>$keyword)
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        @if($keyword != "")
                                           <input type="checkbox" class="custom-control-input child_permission read common-key permission_check{{ $parent_key }}"
                                              data-parent_id="{{ $parent_key }}"  name="permissions[]" value="{{$keyword}}" id="{{$keyword}}" {{in_array($keyword, $data['role_permissions']) ? 'checked':''}}>
                                            <label class="custom-control-label" for="{{$keyword}}">{{Str::title(Str::replace('_',' ',$key))}}</label>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                  </div>
            </td>
        </tr>
    @endforeach
</tbody>
