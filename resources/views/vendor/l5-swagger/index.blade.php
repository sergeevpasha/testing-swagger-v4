@extends('layouts.app')
@section('header')
    <link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset($documentation, 'swagger-ui.css') }}">
    <style>
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            margin: 0;
            background: #fafafa;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                            <div id="swagger-ui" class="max-w-full"></div>
                            <div
                                class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"></script>
        <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"></script>
        <script>
            window.onload = function () {
                // Build a system
                const ui = SwaggerUIBundle({
                    dom_id: '#swagger-ui',
                    url: "{!! $urlToDocs !!}",
                    operationsSorter: {!! isset($operationsSorter) ? '"' . $operationsSorter . '"' : 'null' !!},
                    configUrl: {!! isset($configUrl) ? '"' . $configUrl . '"' : 'null' !!},
                    validatorUrl: {!! isset($validatorUrl) ? '"' . $validatorUrl . '"' : 'null' !!},
                    oauth2RedirectUrl: "{{ route('l5-swagger.'.$documentation.'.oauth2_callback', [], $useAbsolutePath) }}",

                    requestInterceptor: function (request) {
                        request.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
                        return request;
                    },

                    presets: [
                        SwaggerUIBundle.presets.apis,
                        SwaggerUIStandalonePreset
                    ],

                    plugins: [
                        SwaggerUIBundle.plugins.DownloadUrl
                    ],

                    layout: "StandaloneLayout",
                    docExpansion: "{!! config('l5-swagger.defaults.ui.display.doc_expansion', 'none') !!}",
                    deepLinking: true,
                    filter: {!! config('l5-swagger.defaults.ui.display.filter') ? 'true' : 'false' !!},
                    persistAuthorization: "{!! config('l5-swagger.defaults.ui.authorization.persist_authorization') ? 'true' : 'false' !!}",

                })

                window.ui = ui

                @if(in_array('oauth2', array_column(config('l5-swagger.defaults.securityDefinitions.securitySchemes'), 'type')))
                ui.initOAuth({
                    usePkceWithAuthorizationCodeGrant: "{!! (bool)config('l5-swagger.defaults.ui.authorization.oauth2.use_pkce_with_authorization_code_grant') !!}"
                })
                @endif
            }
        </script>
    </div>
@endsection
