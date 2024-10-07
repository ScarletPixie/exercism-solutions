<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);


class Tournament
{
    public $header;
    private const FIELD_WIDTH = 31;
    private const POINT_VALUES = [
        "win" => 3,
        "loss" => 0,
        "draw" => 1,
    ];

    public function __construct()
    {
        $this->header = str_pad('Team', $this::FIELD_WIDTH) . "| MP |  W |  D |  L |  P";
    }
    
    public function tally(string $tournamentInput): string
    {
        $table = [$this->header];

        if ($tournamentInput === '')
        {
            return $table[0];
        }

        $teams = [];
        $inputTeams = $this->getTournamentTeams($tournamentInput);

        //  create team record
        foreach ($inputTeams as $team)
        {
            $teams[$team] = [
                "MP" => 0,
                "W" => 0,
                "D" => 0,
                "L" => 0,
                "P" => 0,
            ];
        }

        //  populate team record
        $teams =  $this->parseMatchesResult($teams, $tournamentInput);

        //  populate table
        $teamsWrapper = [];
        foreach ($teams as $key => $value)
        {
            $teamsWrapper[] = [$key => $value];
        }
        uasort($teamsWrapper, $this->compareByPoints(...));
        foreach ($teamsWrapper as $teamInfo)
        {
            $teamName = array_key_first($teamInfo);
            $format = "%-" . (string)$this::FIELD_WIDTH . "s|  %d |  %d |  %d |  %d |  %d";
            $table[] = sprintf($format,
                                $teamName,
                                $teamInfo[$teamName]['MP'],
                                $teamInfo[$teamName]['W'],
                                $teamInfo[$teamName]['D'],
                                $teamInfo[$teamName]['L'],
                                $teamInfo[$teamName]['P']);
        }

        //  turns table into string
        return join("\n", $table);
    }

    private function parseMatchesResult(array $teams, string $tournamentInput): array
    {
        $entries = explode("\n", $tournamentInput);

        foreach ($entries as $entry)
        {
            $matchInfo = explode(';', $entry);

            $teams[$matchInfo[0]]['MP']++;
            $teams[$matchInfo[1]]['MP']++;
    
            $matchInfo[2] = trim($matchInfo[2]);
            switch ($matchInfo[2])
            {
                case 'draw':
                    $teams[$matchInfo[0]]['D']++;
                    $teams[$matchInfo[1]]['D']++;

                    $teams[$matchInfo[0]]['P'] += $this::POINT_VALUES['draw'];
                    $teams[$matchInfo[1]]['P'] += $this::POINT_VALUES['draw'];
                    break;

                case 'win':
                    $teams[$matchInfo[0]]['W']++;
                    $teams[$matchInfo[0]]['P'] += $this::POINT_VALUES['win'];

                    $teams[$matchInfo[1]]['L']++;
                    break;

                case 'loss':
                    $teams[$matchInfo[0]]['L']++;
                    $teams[$matchInfo[1]]['W']++;
                    $teams[$matchInfo[1]]['P'] += $this::POINT_VALUES['win'];
                    break;
                
                default:
                    throw new Exception('unkown match result.');
            }
        }

        return $teams;
    }

    private function getTournamentTeams(string $tournamentInput): array
    {
        $teams = [];
        $entries = explode("\n", $tournamentInput);

        foreach ($entries as $entry)
        {
            $entryTeams = explode(';', $entry);
            array_push($teams, $entryTeams[0], $entryTeams[1]);
        }

        return $teams;
    }

    private function compareByPoints($entry1, $entry2): int
    {
        $teamName1 = array_key_first($entry1);
        $teamName2 = array_key_first($entry2);

        if ($entry1[$teamName1]['P'] !== $entry2[$teamName2]['P'])
        {
            return ($entry1[$teamName1]['P'] > $entry2[$teamName2]['P']) ? -1 : 1;
        }
        return strcmp($teamName1, $teamName2);
    }
}

$test = new Tournament();

echo $test->tally("Allegoric Alaskans;Blithering Badgers;loss\n" .
"Devastating Donkeys;Allegoric Alaskans;loss\n" .
"Courageous Californians;Blithering Badgers;draw\n" .
"Allegoric Alaskans;Courageous Californians;win");