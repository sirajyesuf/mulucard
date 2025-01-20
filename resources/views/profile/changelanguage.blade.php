<div class="modal fade" id="changeLanguageModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content"@if(getLogInUser()->language == 'ar') dir="rtl" @endif>
            <div class="modal-header">
                <h3>{{ __('messages.user.change_language') }}</h3>
                <button type="button" class="btn-close @if(getLogInUser()->language == 'ar') m-0 @endif" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'changeLanguageForm']) }}
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="alert alert-danger d-none" id="editLanguageValidationErrorsBox"></div>
                    <div>
                            @php
                                $user = Auth::user();
                            @endphp
                            {{ Form::label('Language', __('messages.language').':',['class' => 'form-label']) }}
                            {{ Form::select('language', getAllLanguage(), isset($user) ? getCurrentLanguageName() : null, ['class' => 'form-control form-select', 'required', 'data-control' => 'select2','id' => 'selectLanguage','data-dropdown-parent' => '#changeLanguageModal']) }}
                    </div>
                </div>
                <div class="modal-footer pt-0 @if(getLogInUser()->language == 'ar') gap-2 @endif">
                {{ Form::button(__('messages.common.save'),['class' => 'btn btn-primary m-0','id' => 'languageChangeBtn']) }}
                {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-secondary my-0 ms-5 me-0','data-bs-dismiss' => 'modal']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
