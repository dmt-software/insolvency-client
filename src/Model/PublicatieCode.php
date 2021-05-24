<?php

namespace DMT\Insolvency\Model;

interface PublicatieCode
{
    /** Declaration of bankruptcy in cassation proceedings on [date] */
    public const PUBLICATION_CODE_1200 = '1200';
    /** Bankruptcy de jure as result of interim termination of debt restructuring in cassation on [date] */
    public const PUBLICATION_CODE_1201 = '1201';
    /** Nullification of bankruptcy in cassation on [date] */
    public const PUBLICATION_CODE_1202 = '1202';
    /** Admission to debt restructuring in cassation on [date] */
    public const PUBLICATION_CODE_2200 = '2200';
    /** Conversion of bankruptcy into debt restructuring in cassation on [date] */
    public const PUBLICATION_CODE_2201 = '2201';
    /** Resurgence of debt restructuring because of nullification of bankruptcy in cassation on [date] */
    public const PUBLICATION_CODE_2202 = '2202';
    /** Granting of final moratorium  in cassation on [date] */
    public const PUBLICATION_CODE_3200 = '3200';
    /** Proceedings on appeal to the Supreme Court on rejection of final admission to moratorium on [date] at [time] */
    public const PUBLICATION_CODE_3201 = '3201';
    /** Proceedings on appeal to the Supreme Court on final admission to moratorium on [date] at [time] */
    public const PUBLICATION_CODE_3202 = '3202';
    /** Declaration of bankruptcy in appeal on [date] */
    public const PUBLICATION_CODE_1100 = '1100';
    /** Bankruptcy de jure as result of interim termination of debt restructuring in appeal on [date] */
    public const PUBLICATION_CODE_1101 = '1101';
    /** Nullification of bankruptcy in appeal on [date] */
    public const PUBLICATION_CODE_1102 = '1102';
    /** Admission to debt restructuring in appeal on [date] */
    public const PUBLICATION_CODE_2100 = '2100';
    /** Conversion of bankruptcy into debt restructuring in appeal on [date] */
    public const PUBLICATION_CODE_2101 = '2101';
    /** Resurgence of  debt restructuring because of nullification of bankruptcy in appeal on [date] */
    public const PUBLICATION_CODE_2102 = '2102';
    /** Final admission to moratorium in appeal on [date] */
    public const PUBLICATION_CODE_3100 = '3100';
    /** Hearing court of appeal on rejection of final admission to moratorium on [date] at [time] */
    public const PUBLICATION_CODE_3101 = '3101';
    /** Hearing court of appeal on final admission to moratorium on [date] at [time] */
    public const PUBLICATION_CODE_3102 = '3102';
    /** Rectification */
    public const PUBLICATION_CODE_3310 = '3310';
    /** Rectification */
    public const PUBLICATION_CODE_1323 = '1323';
    /** Rectification */
    public const PUBLICATION_CODE_2300 = '2300';
    /** Declaration of bankruptcy on [date] */
    public const PUBLICATION_CODE_1300 = '1300';
    /** Declaration of bankruptcy as result of interim termination of debt restructuring on [date] */
    public const PUBLICATION_CODE_1301 = '1301';
    /** Declaration of bankruptcy during debt restructuring on [date] */
    public const PUBLICATION_CODE_1302 = '1302';
    /** Declaration of bankruptcy by rescission of debt restructuring agreement on [date] */
    public const PUBLICATION_CODE_1303 = '1303';
    /** Reopening bankruptcy by rescission of bankruptcy agreement on [date] */
    public const PUBLICATION_CODE_1304 = '1304';
    /** Declaration of bankruptcy by rescission of moratorium agreement on [date] */
    public const PUBLICATION_CODE_1305 = '1305';
    /** Declaration of bankruptcy after termination of moratorium on [date] */
    public const PUBLICATION_CODE_1306 = '1306';
    /** Admission to debt restructuring on [date] */
    public const PUBLICATION_CODE_2301 = '2301';
    /** Admission to debt restructuring on [date] and verification meeting on [date] at [time] */
    public const PUBLICATION_CODE_2302 = '2302';

    /**
     * Admission to debt restructuring on [date] and verification meeting with hearing on
     * agreement on [date] at [time]*/
    public const PUBLICATION_CODE_2303 = '2303';
    /** Conversion of bankruptcy into debt restructuring on [date] */
    public const PUBLICATION_CODE_2304 = '2304';
    /** Admission to debt restructuring  after nullification of bankruptcy by opposition on [date] */
    public const PUBLICATION_CODE_2305 = '2305';
    /** Conversion of provisional moratorium into debt restructuring on [date] */
    public const PUBLICATION_CODE_2306 = '2306';
    /** Provisional admission to debt restructuring on [date] */
    public const PUBLICATION_CODE_2307 = '2307';
    /** Conversion of provisonal admission to debt restructuring into a final admission on [date] */
    public const PUBLICATION_CODE_2308 = '2308';
    /** Admission to interim moratorium on [date] meeting of creditors on [date] at [time] */
    public const PUBLICATION_CODE_3300 = '3300';
    /** Admission to interim moratorium on [date] meeting of creditors with hearing on agreement on [date] at [time] */
    public const PUBLICATION_CODE_3301 = '3301';

    /**
     * Admission to final moratorium by order of [date] from [date] for the duration
     * of [variable number of months/years]*/
    public const PUBLICATION_CODE_3302 = '3302';

    /**
     * Extension of moratorium term by order of [date] from [date] for the duration
     * of [variable number of months/years]*/
    public const PUBLICATION_CODE_3303 = '3303';
    /** Replacement of administrator [name former administrator] by [name new administrator] */
    public const PUBLICATION_CODE_1307 = '1307';
    /** Replacement of receiver  [name former receiver] by [name new receiver] */
    public const PUBLICATION_CODE_2309 = '2309';
    /** Replacement of receiver  [name former receiver] by [name new receiver] */
    public const PUBLICATION_CODE_3304 = '3304';
    /** Simplified bankruptcy proceedings */
    public const PUBLICATION_CODE_1308 = '1308';
    /** Verification meeting on [date] at [time] */
    public const PUBLICATION_CODE_1309 = '1309';
    /** Verification meeting and hearing on agreement on [date] at [time] */
    public const PUBLICATION_CODE_1310 = '1310';
    /** Meeting of creditors on [date] at [time] */
    public const PUBLICATION_CODE_1311 = '1311';
    /** Verification meeting on [date] at [time] */
    public const PUBLICATION_CODE_2310 = '2310';
    /** Verification meeting and hearing on agreement on [date] at [time] */
    public const PUBLICATION_CODE_2311 = '2311';
    /** Verification meeting, plan of sanitation and hearing on composition on [date] at [time] */
    public const PUBLICATION_CODE_2312 = '2312';
    /** Resumption of verification meeting, restructuring plan and hearing on agreement on [date] at [time] */
    public const PUBLICATION_CODE_2313 = '2313';
    /** Verification meeting and hearing on adjustment of restructuring plan on [date] at [time] */
    public const PUBLICATION_CODE_2314 = '2314';
    /** Verification meeting and hearing on termination on [date] at [time] */
    public const PUBLICATION_CODE_2315 = '2315';

    /**
     * Verification meeting and hearing on termination on [date] at [time] deposition of final
     * distribution list from [date]*/
    public const PUBLICATION_CODE_2316 = '2316';
    /** Verification meeting and hearing on adjustment of restructuring plan and termination on [date] at [time] */
    public const PUBLICATION_CODE_2317 = '2317';

    /**
     * Verification meeting and hearing on adjustment of restructuring plan and termination on [date] at [time]
     * deposition of distribution list from [date]*/
    public const PUBLICATION_CODE_2318 = '2318';
    /** Hearing on agreement on [date] at [time] */
    public const PUBLICATION_CODE_2319 = '2319';
    /** Hearing on restructuring plan on [date] at [time] */
    public const PUBLICATION_CODE_2320 = '2320';
    /** Hearing on termination on [date] at [time] */
    public const PUBLICATION_CODE_2321 = '2321';
    /** Hearing on termination and adjustment of restructuring plan on [date] at [time] */
    public const PUBLICATION_CODE_2322 = '2322';
    /** Hearing on termination on [date] at [time] deposition of final distribution list from [date] */
    public const PUBLICATION_CODE_2323 = '2323';

    /**
     * Hearing on termination and adjustment of restructuring plan on [date] at [time] deposition of
     * final distribution list from [date]*/
    public const PUBLICATION_CODE_2324 = '2324';
    /** Meeting of creditors on [date] at [time] */
    public const PUBLICATION_CODE_2325 = '2325';
    /** Hearing on extension of moratorium term on [date] at [time]  */
    public const PUBLICATION_CODE_3305 = '3305';
    /** Meeting of creditors with  hearing on agreement on [date] at [time] */
    public const PUBLICATION_CODE_3306 = '3306';
    /** Deposition of interim distribution list from [date] */
    public const PUBLICATION_CODE_1312 = '1312';
    /** Deposition of final distribution list from [date] */
    public const PUBLICATION_CODE_1313 = '1313';
    /** Deposition of final distribution list from [date] */
    public const PUBLICATION_CODE_1314 = '1314';
    /** Simplified bankruptcy proceedings and deposition of final distribution list from [date] */
    public const PUBLICATION_CODE_1315 = '1315';
    /** Deposition of interim distribution list from [date] */
    public const PUBLICATION_CODE_2326 = '2326';
    /** Deposition of final distribution list from [date] */
    public const PUBLICATION_CODE_2327 = '2327';
    /** Removal from bankruptcy due to a lack of assets on [date] */
    public const PUBLICATION_CODE_1316 = '1316';
    /** Termination of bankruptcy by binding distribution list on [date] */
    public const PUBLICATION_CODE_1317 = '1317';
    /** Termination of bankruptcy by approval of agreement  on [date] */
    public const PUBLICATION_CODE_1318 = '1318';
    /** Termination of bankruptcy by binding distribution list after opposition on [date] */
    public const PUBLICATION_CODE_1319 = '1319';
    /** Nullification of bankruptcy after opposition on [date] */
    public const PUBLICATION_CODE_1320 = '1320';
    /** Nullification of bankruptcy after opposition with resurgence of debt restructuring on [date] */
    public const PUBLICATION_CODE_2337 = '2337';
    /** Termination of debt restructuring because all debts are paid on [date] */
    public const PUBLICATION_CODE_2328 = '2328';
    /** Termination of debt restructuring because of resumption of payments on [date] */
    public const PUBLICATION_CODE_2329 = '2329';
    /** Termination of debt restructuring because of approval of agreement on [date] */
    public const PUBLICATION_CODE_2330 = '2330';
    /** Termination of debt restructuring with distribution and clean slate on [date] */
    public const PUBLICATION_CODE_2331 = '2331';
    /** Termination of debt restructuring without distribution, with clean slate on [date] */
    public const PUBLICATION_CODE_2332 = '2332';
    /** Termination of debt restructuring with distribution, without clean slate on [date] */
    public const PUBLICATION_CODE_2333 = '2333';
    /** Termination of debt restructuring without distribution, without clean slate on [date] */
    public const PUBLICATION_CODE_2334 = '2334';
    /** Termination of debt restructuring by rejection of final debt restructuring on [date] */
    public const PUBLICATION_CODE_2335 = '2335';
    /** Termination of moratorium on [date] */
    public const PUBLICATION_CODE_3307 = '3307';
    /** Termination of moratorium because of expiration of term on [date] */
    public const PUBLICATION_CODE_3308 = '3308';
    /** Termination of moratorium by approval of agreement on [date] */
    public const PUBLICATION_CODE_3309 = '3309';
    /** Filing of discharge request  by mr. [name, address of solicitor] */
    public const PUBLICATION_CODE_1322 = '1322';
    /** Deprivation of clean slate in debt restructuring on [date] */
    public const PUBLICATION_CODE_2336 = '2336';
    /** Termination of bankruptcy because all debts are paid on [date] */
    public const PUBLICATION_CODE_1324 = '1324';
    /** Pro forma verification meeting */
    public const PUBLICATION_CODE_1325 = '1325';
    /** Pro forma verification meeting and hearing on agreement */
    public const PUBLICATION_CODE_1326 = '1326';
    /** Pro forma admission to debt restructuring and verification meeting */
    public const PUBLICATION_CODE_2338 = '2338';
    /** Pro forma admission to debt restructuring and verification meeting with  hearing on agreement */
    public const PUBLICATION_CODE_2339 = '2339';
    /** Pro forma verification meeting */
    public const PUBLICATION_CODE_2340 = '2340';
    /** Pro forma verification meeting and hearing on agreement */
    public const PUBLICATION_CODE_2341 = '2341';
    /** Pro forma verification meeting, restructuring plan and hearing on agreement */
    public const PUBLICATION_CODE_2342 = '2342';
    /** Pro forma verification meeting and hearing on adjustment of restructuring plan */
    public const PUBLICATION_CODE_2343 = '2343';
    /** Pro forma verification meeting, hearing on termination */
    public const PUBLICATION_CODE_2344 = '2344';
    /** Pro forma verification meeting, hearing on termination and deposition of distribution list  */
    public const PUBLICATION_CODE_2345 = '2345';
    /** Pro forma verification meeting and hearing on adjustment of restructuring plan and termination */
    public const PUBLICATION_CODE_2346 = '2346';

    /**
     * Pro forma verification meeting and hearing on adjustment of restructuring plan and termination and deposition of
     * distribution list from*/
    public const PUBLICATION_CODE_2347 = '2347';
    /** Rendered and accounted */
    public const PUBLICATION_CODE_2348 = '2348';
    /** Replacement supervisory judge */
    public const PUBLICATION_CODE_1328 = '1328';
    /** Replacement supervisory judge */
    public const PUBLICATION_CODE_2349 = '2349';
    /** Replacement supervisory judge */
    public const PUBLICATION_CODE_3311 = '3311';
    /** Additional mail blockade */
    public const PUBLICATION_CODE_1330 = '1330';
    /** Change of address */
    public const PUBLICATION_CODE_1331 = '1331';
    /** Interim abrogation mail blockade */
    public const PUBLICATION_CODE_1332 = '1332';
    /** Additional mail blockade */
    public const PUBLICATION_CODE_2351 = '2351';
    /** Change of address */
    public const PUBLICATION_CODE_2352 = '2352';
    /** Interim abrogation mail blockade */
    public const PUBLICATION_CODE_2353 = '2353';
    /** Termination of suspension of payments by conversion into bankruptcy on */
    public const PUBLICATION_CODE_3313 = '3313';
    /** Bankruptcy transferred to other district court on */
    public const PUBLICATION_CODE_1334 = '1334';
    /** Bankruptcy converted into debt restructuring on */
    public const PUBLICATION_CODE_1333 = '1333';
    /** Debt restructuring transferred to other district court on */
    public const PUBLICATION_CODE_2355 = '2355';
    /** Premature termination of debt restructuring by declaration of bankruptcy on */
    public const PUBLICATION_CODE_2354 = '2354';
    /** Suspension of payments transferred to other district court on */
    public const PUBLICATION_CODE_3314 = '3314';
}
