<x-title-wrapper-return area="#kt_content" title="Back To Lists" url="{{route('audit.plan.strategy.indicator.output')}}">
    Details
</x-title-wrapper-return>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    @foreach ($data['data'] as $data)
                        <h3 class="text-center">{{ $data['output_no'] }}</h3>
                        <p class="text-center">{{ $data['remarks'] }}</p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="align-middle">Indicator</th>
                                        <th>Frequency of Measurement</th>
                                        <th>Data source</th>
                                        @foreach($fiscal_years as $fiscal_year)
                                            <th>
                                                @if($loop->first) Baseline
                                                @elseif($loop->last) Target
                                                @else Milestone @endif
                                                {{$fiscal_year['start']}}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['indicators'] as $indicator)
                                    <tr>
                                        <td><span>{{ $indicator['name_en'] }}</span></td>
                                        <td><span>{{ $indicator['frequency_en'] }}</span></td>
                                        <td><span>{{ $indicator['datasource_en'] }}</span></td>
                                        <td><span>{{ $indicator['base_value'] }}</span></td>
                                        @foreach ($indicator['details'] as $detail)
                                            <td>{{$detail['target_value']}}{{$detail['unit_type'] == "Percentage" ? '%':''}}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>