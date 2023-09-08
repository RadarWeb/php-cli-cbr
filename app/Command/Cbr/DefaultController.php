<?php

namespace Command\Cbr;

use Carbon\Carbon;
use DOMDocument;
use Minicli\App;
use Minicli\Command\CommandCall;
use Minicli\Command\CommandController;

class DefaultController extends CommandController {
	/** @var  array */
	protected array $command_map;
	protected array $list;

	public function boot(App $app, CommandCall $input): void {
		parent::boot($app, $input);
		$this->command_map = $app->commandRegistry->getCommandMap();
	}

	public function handle(): void {

		$xml = new DOMDocument();

		$week_num = Carbon::now()->week();

		$prev_monday = (new Carbon())->week($week_num - 1)->startOfWeek();

		$days_count = Carbon::now()->diffInDays($prev_monday);

		$view = [];

		$currencies = [
			'EUR',
			'USD',
			'KGS',
		];

		for($i = 0; $i < $days_count + 1; $i++) {

			$date = $prev_monday->copy()->addDays($i);

			$url = 'https://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $date->format('d.m.Y');

			if(@$xml->load($url)) {
				$this->list = [];

				$root     = $xml->documentElement;
				$items    = $root->getElementsByTagName('Valute');
				$cur_data = [];

				foreach($items as $item) {
					$code              = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
					$curs              = $item->getElementsByTagName('Value')->item(0)->nodeValue;
					$this->list[$code] = floatval(str_replace(',', '.', $curs));
					if(in_array($code, $currencies)) {
						$cur_data[$code] = $this->get($code);
					}
				}

				$view[$date->format('Y-m-d')] = $cur_data;
			}
		}

		var_export($view);

		//$this->success(json_encode($view));
	}

	private function get($cur) {
		return $this->list[$cur] ?? 0;
	}
}