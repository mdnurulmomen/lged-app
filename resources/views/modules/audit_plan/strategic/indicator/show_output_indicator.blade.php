<x-title-wrapper-return area="#kt_content" title="Back To Lists" url="{{route('audit.plan.strategy.indicator.outcome')}}">
    Outcome Indicator
</x-title-wrapper-return>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <!--begin::Table-->
                    <h3 class="text-center">{{ $data['output'][0]['output_no'] }}</h3>
                    <p class="text-center">{{ $data['output'][0]['remarks'] }}</p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th class="align-middle">Indicator</th>
                                    <th>Frequency of Measurement</th>
                                    <th>Data source</th>
                                    <th>Baseline FY {{ $data['year']['start'] }}</th>
                                    @foreach ($data['details'] as $detail)
                                        <th>
                                            @if($loop->last)
                                            Target
                                            @else
                                            Milestone
                                            @endif FY {{$detail['year']['start']}}</th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span>{{ $data['name_en'] }}</span></td>
                                    <td><span>{{ $data['frequency_en'] }}</span></td>
                                    <td><span>{{ $data['datasource_en'] }}</span></td>
                                    <td><span>{{ $data['base_value'] }}</span></td>
                                    @foreach ($data['details'] as $detail)
                                        <td>{{$detail['target_value']}}{{$detail['unit_type'] == "Percentage" ? '%':''}}</td>
                                    @endforeach


                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>