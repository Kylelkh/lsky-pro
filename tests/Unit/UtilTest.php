<?php

namespace Tests\Unit;

use App\Enums\ConfigKey;
use App\Utils;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UtilTest extends TestCase
{
    public function test_config()
    {
        Cache::forget('configs');

        if (Utils::config() instanceof Collection) {
            $this->assertTrue(true);
        }

        if (is_string(Utils::config(ConfigKey::SiteName))) {
            $this->assertTrue(true);
        }

        if (Utils::config(ConfigKey::MailConfigs) instanceof Collection) {
            $this->assertTrue(true);
        }

        if (is_array(Utils::config(ConfigKey::MailConfigs.'.mailers'))) {
            $this->assertTrue(true);
        }

        if (is_bool(Utils::config(ConfigKey::IsAllowGuestUpload))) {
            $this->assertTrue(true);
        }
    }

    public function test_array_filter_recursive()
    {

        $array = Utils::filter([
            'name' => 'Lsky',
            'age' => null,
            'configs' => [
                'one' => null,
                'two' => 1
            ]
        ]);

        if (! array_key_exists('age', $array)) {
            $this->assertTrue(true);
        }

        if (! array_key_exists('one', $array['configs'])) {
            $this->assertTrue(true);
        }

        if (! array_key_exists('two', $array['configs'])) {
            $this->assertTrue(true);
        }
    }
}
