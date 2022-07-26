<?php

use App\Page;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Company::class, 2)->create()->each(function (\App\Company $company) {
            factory(\App\User::class, 2)->create(['company_id' => $company->id]);

            factory(\App\Page::class, 2)->create(['company_id' => $company->id])->each(function (\App\Page $page) {
                $this->createPageTextsAndKeys($page);

                factory(\App\PageSubmit::class, 30)->create(['page_id' => $page->id])->each(function (\App\PageSubmit $pageSubmit) use ($page) {
                    foreach ($page->pageKeys as $pageKey) {
                        factory(\App\PageSubmitValue::class)->create(['page_submit_id' => $pageSubmit->id, 'key' => $pageKey->key]);
                    }
                });
            });
        });
    }

    /**
     * @param Page $page
     */
    protected function createPageTextsAndKeys(Page $page)
    {
        switch ($page->template) {
            case 'invite':
                $page->pageTexts()->create(['key' => 'event_description', 'name' => 'Event description', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.']);
                $page->pageTexts()->create(['key' => 'contact_form_title', 'name' => 'Contact form title', 'value' => 'Lust dabei zu sein?']);
                $page->pageTexts()->create(['key' => 'feedback_option_1', 'name' => 'Feedback option 1', 'value' => 'Ja, ich komme']);
                $page->pageTexts()->create(['key' => 'feedback_option_2', 'name' => 'Feedback option 2', 'value' => 'Nein, ich komme nicht']);
                $page->pageTexts()->create(['key' => 'thanks_page_title', 'name' => 'Thanks page title', 'value' => 'Danke!']);
                $page->pageTexts()->create(['key' => 'pity_page_title', 'name' => 'Pity page title', 'value' => 'Schade!']);
                $page->pageTexts()->create(['key' => 'thanks_page_text', 'name' => 'Thanks page text', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.']);
                $page->pageTexts()->create(['key' => 'pity_page_text', 'name' => 'Pity page text', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.']);
                $page->pageTexts()->create(['key' => 'facebook_link', 'name' => 'Facebook link', 'value' => 'http://google.com']);
                $page->pageTexts()->create(['key' => 'youtube_link', 'name' => 'Youtube link', 'value' => 'http://google.com']);
                $page->pageTexts()->create(['key' => 'instagram_link', 'name' => 'Instagram link', 'value' => 'http://google.com']);

                $page->pageKeys()->create(['key' => 'coming', 'name' => 'Komme']);
                $page->pageKeys()->create(['key' => 'gender', 'name' => 'Geschlecht']);
                $page->pageKeys()->create(['key' => 'company', 'name' => 'Firma']);
                $page->pageKeys()->create(['key' => 'first_name', 'name' => 'Vorname']);
                $page->pageKeys()->create(['key' => 'name', 'name' => 'Name']);
                $page->pageKeys()->create(['key' => 'email', 'name' => 'E-mail']);
                $page->pageKeys()->create(['key' => 'gender_2', 'name' => 'Begleit Geschlecht']);
                $page->pageKeys()->create(['key' => 'company_2', 'name' => 'Begleit Firma']);
                $page->pageKeys()->create(['key' => 'first_name_2', 'name' => 'Begleit Vorname']);
                $page->pageKeys()->create(['key' => 'name_2', 'name' => 'Begleit Name']);
                $page->pageKeys()->create(['key' => 'email_2', 'name' => 'Begleit E-mail']);
                break;
            case 'competition-winhuus':
                $page->pageTexts()->create(['key' => 'competition_title', 'name' => 'Competition title', 'value' => 'Jetzt gewinnen!']);
                $page->pageTexts()->create(['key' => 'prize_1_title', 'name' => 'Prize 1 title', 'value' => '4 Übernachtungen für 2 Personen, Zimmer und Frühstück und angebotenen Aktivitäten*']);
                $page->pageTexts()->create(['key' => 'prize_2_title', 'name' => 'Prize 2 title', 'value' => '3 Übernachtungen für 2 Personen, Zimmer und Frühstück und angebotenen Aktivitäten*']);
                $page->pageTexts()->create(['key' => 'prize_3_title', 'name' => 'Prize 3 title', 'value' => '2 Übernachtungen für 2 Personen, Zimmer und Frühstück und angebotenen Aktivitäten*']);
                $page->pageTexts()->create(['key' => 'prize_small_print', 'name' => 'Prize small print', 'value' => '*Zimmer, Frühstück und angebotene Aktivitäten']);
                $page->pageTexts()->create(['key' => 'competition_description', 'name' => 'Competition description', 'value' => 'Das Einkaufszentrum ShopVille verlost in Zusammenarbeit mit dem HUUS Gstaad Hotel drei tolle Übernachtungspakete. Lassen Sie sich die Chance nicht entgehen, beantworten Sie die Wettbewerbsfrage und nehmen Sie an der Verlosung teil.']);
                $page->pageTexts()->create(['key' => 'competition_subline', 'name' => 'Competition subline', 'value' => 'Jetzt Frage beantworten und gewinnen:']);
                $page->pageTexts()->create(['key' => 'question', 'name' => 'Question', 'value' => 'Wie viele Zimmer hat das HUUS Gstaad Hotel?']);
                $page->pageTexts()->create(['key' => 'answer_1', 'name' => 'Answer 1', 'value' => '99']);
                $page->pageTexts()->create(['key' => 'answer_2', 'name' => 'Answer 2', 'value' => '136']);
                $page->pageTexts()->create(['key' => 'answer_3', 'name' => 'Answer 3', 'value' => '232']);
                $page->pageTexts()->create(['key' => 'congrats_page_title', 'name' => 'Congrats page title', 'value' => 'Glückwunsch!']);
                $page->pageTexts()->create(['key' => 'congrats_page_text', 'name' => 'Congrats page text', 'value' => 'Sie haben die Frage richtig beantwortet und nehmen an der Verlosung teil.']);
                $page->pageTexts()->create(['key' => 'form_title', 'name' => 'Form title', 'value' => 'Meine Kontaktangaben']);
                $page->pageTexts()->create(['key' => 'try_again_page_title', 'name' => 'Try again page title', 'value' => 'Ihre Antwort ist leider falsch!']);
                $page->pageTexts()->create(['key' => 'try_again_page_text', 'name' => 'Try again page text', 'value' => 'Nicht aufgeben. Versuchen Sie es gleich noch einmal!']);
                $page->pageTexts()->create(['key' => 'final_page_title', 'name' => 'Final page title', 'value' => 'Herzlichen Dank!']);
                $page->pageTexts()->create(['key' => 'final_page_text', 'name' => 'Final page text', 'value' => "Herzlichen Dank für die Teilnahme an unserem Wettbewerb. Ihre Angaben wurden erfolgreich übermittelt. Bitte beachten Sie, dass jede Person nur einmal teilnahmeberechtigt ist. Eine Mehrfachteilnahme führt zum Ausschluss vom Wettbewerb."."\n"."\n"."Wir wünschen Ihnen viel Glück."]);
                $page->pageTexts()->create(['key' => 'logo_link', 'name' => 'Logo link', 'value' => 'http://google.com']);
                $page->pageTexts()->create(['key' => 'sbb_link', 'name' => 'SBB link', 'value' => 'http://google.com']);
                $page->pageTexts()->create(['key' => 'shopville_link', 'name' => 'Shopville link', 'value' => 'http://google.com']);
                $page->pageTexts()->create(['key' => 'facebook_link', 'name' => 'Facebook link', 'value' => 'http://google.com']);
                $page->pageTexts()->create(['key' => 'youtube_link', 'name' => 'Youtube link', 'value' => 'http://google.com']);
                $page->pageTexts()->create(['key' => 'instagram_link', 'name' => 'Instagram link', 'value' => 'http://google.com']);

                $page->pageKeys()->create(['key' => 'gender', 'name' => 'Geschlecht']);
                $page->pageKeys()->create(['key' => 'first_name', 'name' => 'Vorname']);
                $page->pageKeys()->create(['key' => 'name', 'name' => 'Name']);
                $page->pageKeys()->create(['key' => 'email', 'name' => 'E-Mail']);
                $page->pageKeys()->create(['key' => 'phone', 'name' => 'Telefonnummer']);
                $page->pageKeys()->create(['key' => 'date', 'name' => 'Geburtsdatum']);
                $page->pageKeys()->create(['key' => 'terms', 'name' => 'Terms accepted']);
                $page->pageKeys()->create(['key' => 'newsletter', 'name' => 'Newsletter signup']);
                break;
            default:
                $page->pageTexts()->create(['key' => 'prize_1_title', 'name' => 'Prize 1 title', 'value' => 'Lorem ipsum dolor sit amet']);
                $page->pageTexts()->create(['key' => 'prize_2_title', 'name' => 'Prize 2 title', 'value' => 'Lorem ipsum dolor sit amet']);
                $page->pageTexts()->create(['key' => 'prize_3_title', 'name' => 'Prize 3 title', 'value' => 'Lorem ipsum dolor sit amet']);
                $page->pageTexts()->create(['key' => 'competition_description', 'name' => 'Competition description', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.']);
                $page->pageTexts()->create(['key' => 'competition_subline', 'name' => 'Competition subline', 'value' => 'Frage beantworten und gewinnen!']);
                $page->pageTexts()->create(['key' => 'question', 'name' => 'Question', 'value' => 'Wer bringt an Weihnachten die Geschenke?']);
                $page->pageTexts()->create(['key' => 'answer_1', 'name' => 'Answer 1', 'value' => 'Die Grossmutter']);
                $page->pageTexts()->create(['key' => 'answer_2', 'name' => 'Answer 2', 'value' => 'Das Christkind']);
                $page->pageTexts()->create(['key' => 'congrats_page_title', 'name' => 'Congrats page title', 'value' => 'Glückwunsch!']);
                $page->pageTexts()->create(['key' => 'congrats_page_text', 'name' => 'Congrats page text', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.']);
                $page->pageTexts()->create(['key' => 'try_again_page_title', 'name' => 'Try again page title', 'value' => 'Try again!']);
                $page->pageTexts()->create(['key' => 'try_again_page_text', 'name' => 'Try again page text', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.']);
                $page->pageTexts()->create(['key' => 'final_page_title', 'name' => 'Final page title', 'value' => 'All done!']);
                $page->pageTexts()->create(['key' => 'final_page_text', 'name' => 'Final page text', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.']);
                $page->pageTexts()->create(['key' => 'facebook_link', 'name' => 'Facebook link', 'value' => 'http://google.com']);
                $page->pageTexts()->create(['key' => 'youtube_link', 'name' => 'Youtube link', 'value' => 'http://google.com']);
                $page->pageTexts()->create(['key' => 'instagram_link', 'name' => 'Instagram link', 'value' => 'http://google.com']);

                $page->pageKeys()->create(['key' => 'gender', 'name' => 'Geschlecht']);
                $page->pageKeys()->create(['key' => 'first_name', 'name' => 'Vorname']);
                $page->pageKeys()->create(['key' => 'name', 'name' => 'Name']);
                $page->pageKeys()->create(['key' => 'email', 'name' => 'E-Mail']);
                $page->pageKeys()->create(['key' => 'date', 'name' => 'Geburtsdatum']);
                $page->pageKeys()->create(['key' => 'terms', 'name' => 'Terms accepted']);
                $page->pageKeys()->create(['key' => 'newsletter', 'name' => 'Newsletter signup']);
                break;
        }
    }
}
