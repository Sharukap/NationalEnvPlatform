
--
-- Database: `finals`
--

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Additional Director', '2020-11-06 19:21:06', NULL, NULL),
(2, 'Manager', '2020-11-06 19:21:21', NULL, NULL),
(3, 'Director', '2020-11-06 19:21:36', NULL, NULL),
(4, 'Staff Assistant', '2020-11-06 19:22:33', NULL, NULL),
(5, 'Assistant Director', '2020-11-06 19:22:58', NULL, NULL),
(6, 'Deputy Manager', '2020-11-06 19:23:39', NULL, NULL),
(7, 'Assistant Manager', '2020-11-06 19:23:53', NULL, NULL);

--
-- Dumping data for table `form_types`
--

INSERT INTO `form_types` (`id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tree Removal', '2020-11-16 19:15:59', NULL, NULL),
(2, 'Development Project', '2020-11-16 19:16:44', NULL, NULL),
(3, 'Restoration Project', '2020-11-16 19:16:44', NULL, NULL),
(4, 'Crime Complaint', '2020-11-16 19:16:44', NULL, NULL),
(5, 'Land_Parcels', NULL, NULL, NULL);

--
-- Dumping data for table `environment_restoration_activities`
--

INSERT INTO `environment_restoration_activities` (`id`, `title`, `created_by_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Forest Preservation', 1, NULL, NULL, NULL),
(2, 'Coral Restoration', 1, NULL, NULL, NULL),
(3, 'Wetland Restoration', 1, NULL, NULL, NULL),
(4, 'Riverbed Restoration', 1, NULL, NULL, NULL);

--
-- Dumping data for table `gazettes`
--

INSERT INTO `gazettes` (`id`, `title`, `gazette_number`, `gazetted_date`, `degazetted_date`, `organizations`, `content`, `created_by_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gazette 1', 'No. 2206/22 of 18.12.2020', '2020-11-15', '0000-00-00', '[\"1\",\"2\",\"3\"]', 'Test', 1, '2020-11-14 22:13:35', NULL, NULL),
(2, 'Gazette 2', 'No. 2188/46 of 14.08.2020', '2020-11-15', '0000-00-00', '[\"4\",\"2\",\"3\"]', 'Test', 1, '2020-11-14 22:15:26', NULL, NULL),
(3, 'Gazette 3', 'No. 2188/2 of 13.08.2020', '2020-11-15', '0000-00-00', '[\"1\",\"5\",\"3\"]', 'Test', 1, '2020-11-14 22:15:26', NULL, NULL),
(4, 'Gazette 4', 'No. 2187/26 of 10.08.2020', '2020-11-15', '0000-00-00', '[\"7\",\"2\",\"3\"]', 'Test', 1, '2020-11-14 22:15:26', NULL, NULL),
(5, 'Gazette 5', 'No. 2187/2 of 08.08.2020', '2020-11-15', '0000-00-00', '[\"4\",\"5\",\"3\"]', 'Test', 1, '2020-11-14 22:15:26', NULL, NULL),
(6, 'Gazette 6', 'No. 2179/17 of 03.08.2020', '2020-11-15', '0000-00-00', '[\"5\",\"1\",\"3\"]', 'Test', 1, '2020-11-14 22:15:26', NULL, NULL),
(7, 'Gazette 7', 'No. 2167/13 of 10.06.2020', '2020-11-15', '0000-00-00', '[\"3\",\"2\"]', 'Test', 1, '2020-11-14 22:15:26', NULL, NULL);

--
-- Dumping data for table `gs_divisions`
--

INSERT INTO `gs_divisions` (`id`, `gs_division`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Aluthkade East', '2020-11-16 17:05:12', NULL, NULL),
(2, 'Bloemendhal', '2020-11-16 17:06:00', NULL, NULL),
(3, 'Fort', '2020-11-16 17:06:00', NULL, NULL),
(4, 'Grandpass South', '2020-11-16 17:06:00', NULL, NULL),
(5, 'Kochchikade South', '2020-11-16 17:06:00', NULL, NULL),
(6, 'Kotahena East', '2020-11-16 17:06:00', NULL, NULL),
(7, 'Lunupokuna', '2020-11-16 17:06:00', NULL, NULL),
(8, 'Madampitiya', '2020-11-16 17:06:00', NULL, NULL),
(9, 'Mahawatta', '2020-11-16 17:06:00', NULL, NULL),
(10, 'Maligakanda', '2020-11-16 17:06:00', NULL, NULL),
(11, 'New Bazaar', '2020-11-16 17:06:00', NULL, NULL),
(12, 'Sammanthranapura', '2020-11-16 17:06:00', NULL, NULL),
(13, 'Slave Island', '2020-11-16 17:06:00', NULL, NULL),
(14, 'Galwadugoda', '2020-11-16 17:06:00', NULL, NULL),
(15, 'Minuwangoda', '2020-11-16 17:06:00', NULL, NULL),
(16, 'Pettigalawatta', '2020-11-16 17:06:00', NULL, NULL),
(17, 'Gangodavila East', '2020-11-16 17:06:00', NULL, NULL),
(18, 'Nawala West', '2020-11-16 17:06:00', NULL, NULL),
(19, 'Nugegoda', '2020-11-16 17:06:00', NULL, NULL),
(20, 'Pagoda East', '2020-11-16 17:06:00', NULL, NULL),
(21, 'Rajagiriya', '2020-11-16 17:06:00', NULL, NULL);

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `province`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Central', '2020-11-16 22:30:39', NULL, NULL),
(2, 'Eastern', '2020-11-16 22:32:17', NULL, NULL),
(3, 'Nothern', '2020-11-16 22:32:17', NULL, NULL),
(4, 'Southern', '2020-11-16 22:32:17', NULL, NULL),
(5, 'Western', '2020-11-16 22:32:17', NULL, NULL),
(6, 'North Western', '2020-11-16 22:32:17', NULL, NULL),
(7, 'North Central', '2020-11-16 22:32:17', NULL, NULL),
(8, 'Uva', '2020-11-16 22:32:17', NULL, NULL),
(9, 'Sabaragamuwa', '2020-11-16 22:32:17', NULL, NULL);

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `district`, `created_at`, `updated_at`, `deleted_at`, `province_id`) VALUES
(1, 'Ampara', '2020-11-16 22:23:46', NULL, NULL, 2),
(2, 'Anuradhapura', '2020-11-16 22:29:46', NULL, NULL, 7),
(3, 'Badulla', '2020-11-16 22:29:46', NULL, NULL, 8),
(4, 'Batticaloa', '2020-11-16 22:29:46', NULL, NULL, 2),
(5, 'Colombo', '2020-11-16 22:29:46', NULL, NULL, 5),
(6, 'Galle', '2020-11-16 22:29:46', NULL, NULL, 4),
(7, 'Gampaha', '2020-11-16 22:29:46', NULL, NULL, 5),
(8, 'Hambantota', '2020-11-16 22:29:46', NULL, NULL, 4),
(9, 'Jaffna', '2020-11-16 22:29:46', NULL, NULL, 3),
(10, 'Kalutara', '2020-11-16 22:29:46', NULL, NULL, 5),
(11, 'Kandy', '2020-11-16 22:29:46', NULL, NULL, 1),
(12, 'Kegalle', '2020-11-16 22:29:46', NULL, NULL, 9),
(13, 'Kilinochchi', '2020-11-16 22:29:46', NULL, NULL, 3),
(14, 'Kurunegala', '2020-11-16 22:29:46', NULL, NULL, 6),
(15, 'Mannar', '2020-11-16 22:29:46', NULL, NULL, 3),
(16, 'Matale', '2020-11-16 22:29:46', NULL, NULL, 1),
(17, 'Matara', '2020-11-16 22:29:46', NULL, NULL, 4),
(18, 'Monaragala', '2020-11-16 22:29:46', NULL, NULL, 8),
(19, 'Mullaitivu', '2020-11-16 22:29:46', NULL, NULL, 3),
(20, 'Nuwara Eliya', '2020-11-16 22:29:46', NULL, NULL, 1),
(21, 'Polonnaruwa', '2020-11-16 22:29:46', NULL, NULL, 7),
(22, 'Puttalam', '2020-11-16 22:29:46', NULL, NULL, 6),
(23, 'Ratnapura', '2020-11-16 22:29:46', NULL, NULL, 9),
(24, 'Trincomalee', '2020-11-16 22:29:46', NULL, NULL, 2),
(25, 'Vavuniya', '2020-11-16 22:29:46', NULL, NULL, 3);

--
-- Dumping data for table `organization_types`
--

INSERT INTO `organization_types` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Government ', '2021-01-09 19:09:06', NULL, NULL),
(2, 'Semi-Government ', '2021-01-09 19:11:16', NULL, NULL),
(3, 'Private ', '2021-01-09 19:11:16', NULL, NULL),
(4, 'Non-government ', '2021-01-09 19:11:16', NULL, NULL),
(5, 'Public ', '2021-01-09 19:11:16', NULL, NULL),
(6, 'Other ', '2021-01-09 19:11:16', NULL, NULL);

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `title`, `city`, `country`, `type_id`, `description`, `created_at`, `updated_at`, `status`, `deleted_at`) VALUES
(1, 'Reforest Sri Lanka', 'Colombo', 'Sri Lanka', 4, 'Software Creator', '2021-03-31 09:17:01', '2021-03-31 09:17:01', 1, NULL),
(2, 'Ministry of Environment', 'Battaramulla', 'Sri Lanka', 1, '', '2020-11-05 22:56:03', NULL, 1, NULL),
(3, 'Central Environmental Authority', 'Colombo', 'Sri Lanka', 1, '', '2020-11-05 22:59:13', NULL, 1, NULL),
(4, 'Ministry of Wildlife', 'Colombo', 'Sri Lanka', 1, '', '2020-11-05 22:59:55', NULL, 1, NULL),
(5, 'Road Development Authority', 'Colombo', 'Sri Lanka', 1, '', '2020-11-05 23:00:48', NULL, 1, NULL);

--
-- Dumping data for table `organization_contacts`
--

INSERT INTO `organization_contacts` (`id`, `org_id`, `type`, `contact_signature`, `primary`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Mobile Number', '0777777777', 1, '2021-03-31 09:17:01', '2021-03-31 09:17:01', NULL),
(2, 1, 'email', 'reforest@gmail.com', 1, '2021-03-31 09:17:01', '2021-03-31 09:17:01', NULL);


--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', '2020-11-05 23:01:23', NULL, NULL),
(2, 'Admin', '2020-11-05 23:01:36', NULL, NULL),
(3, 'Head of Organization', '2020-11-05 23:02:00', NULL, NULL),
(4, 'Manager', '2020-11-05 23:02:46', NULL, NULL),
(5, 'Staff', '2020-11-05 23:03:00', NULL, NULL),
(6, 'Citizen', '2020-11-05 23:03:14', NULL, NULL);

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Application made successfully', NULL, NULL, NULL),
(2, 'Forwarded to the organization', NULL, NULL, NULL),
(3, 'Assigned for approval', NULL, NULL, NULL),
(4, 'Reviewing for approval', NULL, NULL, NULL),
(5, 'Approved', NULL, NULL, NULL),
(6, 'Rejected', NULL, NULL, NULL),
(7, 'System Data', NULL, NULL, NULL),
(8, 'Cancelled by Requester', NULL, NULL, NULL);


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `created_by_user_id`, `remember_token`, `created_at`, `updated_at`, `status`, `deleted_at`, `role_id`, `organization_id`, `designation_id`) VALUES
(2, 'Bojitha Piyatilleke', 'boji@yahoo.com', '2020-11-05 07:04:42', '$2y$10$naVkPx5K0iW7PzW/z9cfXO8ZM64k191EA4PtlKRdPXaIbpRyKDQi6', NULL, NULL, 0, NULL, '2020-11-05 07:04:17', '2020-11-08 08:16:21', 1, NULL, 1, 1, 4),
(3, 'Senal Hewage', 'senal@yahoo.com', '2020-11-05 07:51:28', '$2y$10$aQKl0mccMLeFACu49Phd/eQIGwAzr.nSdJUg.CpmGZpqjYfK.0iAG', NULL, NULL, 0, NULL, '2020-11-05 07:51:19', '2020-11-07 09:45:31', 1, NULL, 2, 3, 2),
(4, 'Thidas Perera', 'thidas@yahoo.com', '2020-11-05 07:51:57', '$2y$10$9yhxcd2voxOAUXSBIxLSsubp4pvlLfF1jow6tPNgEwY0yZ5fsGxI6', NULL, NULL, 0, '5CVq4QncsiXfYiVPkCMK97hrxmWn12nNWOd39mQJNXikToLt5kU823TUOK6E', '2020-11-05 07:51:47', '2020-11-12 13:26:27', 1, NULL, 3, 3, 5),
(5, 'Sharuka Perera', 'sharuka@yahoo.com', '2020-11-05 07:52:33', '$2y$10$txPjtcvlhyqfxP2aCQ8DYevyVVWYe8a/ljiTDsnQmFb.tFH6AyOaC', NULL, NULL, 0, NULL, '2020-11-05 07:52:22', '2020-11-12 14:15:17', 1, NULL, 4, 2, 2),
(6, 'Benjamin Subasinghe', 'benjamin@yahoo.com', '2020-11-05 07:53:11', '$2y$10$8MgZnq29OAFAGpIfN5CuLud3MbQZO5dmMTPETIOgkcIFWOgVnPPS6', NULL, NULL, 0, NULL, '2020-11-05 07:53:03', '2020-11-07 11:53:38', 1, NULL, 4, 3, 1),
(7, 'Dion Weiman', 'dionwei@gmail.com', '2020-11-05 08:27:05', '$2y$10$eVSi6Qwnf1OgEcAuMh.XAOC6muhwT6pOvZY1Kgw8XfCir22/br8Tu', NULL, NULL, 0, NULL, '2020-11-05 08:17:04', '2020-11-07 18:35:31', 1, NULL, 4, 4, 5),
(8, 'Chayu Damsinghe', 'chayu@yahoo.com', '2020-11-05 08:27:47', '$2y$10$4TS0d9TIyPROVTGTP80A.eRlZpEnlC4K3D6P0Rx6cr.20cw9iCxEi', NULL, NULL, 0, NULL, '2020-11-05 08:27:37', '2020-11-06 12:17:44', 0, NULL, NULL, NULL, NULL),
(13, 'Hammond Silva', 'hammondsilva@yahoo.com', NULL, '$2y$10$GMsvdbj/bQpezQYLytYDG.6Uu5Ra4aomhXIwomSWlh/bMuPh0sOyu', NULL, NULL, 2, NULL, '2020-11-06 14:41:44', '2020-11-08 08:12:45', 1, NULL, 5, 3, 3),
(14, 'Bobby Shades', 'bobby@gmail.com', NULL, '$2y$10$jUB/fSIiIxcjQMh90hRa..asNS19VoEi7a1qNsJtECSM4AktSXMSq', NULL, NULL, 2, NULL, '2020-11-06 14:51:11', '2020-11-07 11:41:03', 1, NULL, 4, 2, 7),
(19, 'Sarah', 'sarah@yahoo.com', NULL, '$2y$10$xHzN.6IxzDSLe/qDObMofOrlqXEVGiurVhwp/Dtf4bnPk1x2z31xy', NULL, NULL, 2, NULL, '2020-11-06 14:56:48', '2020-11-06 14:56:48', 0, NULL, NULL, NULL, NULL),
(20, 'Gordon', 'gordon@yahoo.com', NULL, '$2y$10$uGkEyLDciZD1P5QgLBzEW.DNfCZEWDuVfvVPJ2FxZeB8pYquwb3tu', NULL, NULL, 2, NULL, '2020-11-06 14:57:40', '2020-11-29 20:36:23', 1, NULL, 4, 3, 3),
(21, 'Samuel Jackson', 'sam@gmail.com', NULL, '$2y$10$xfyH2kQfUQ4GOTxWFpFALO7ejS1zKzfIUs7Nc1oKi8PYEdSDvp6WO', NULL, NULL, 2, NULL, '2020-11-07 04:52:21', '2020-11-07 06:44:02', 0, NULL, NULL, NULL, NULL),
(22, 'Samantha Perera', 'samantha@gmail.com', '2020-11-07 11:34:08', '$2y$10$/ZjyZnCEdOUt90w8byo5Uuj1E/nkzNlGNSJ9eZnSDE71qJ/Iq5pT.', NULL, NULL, 2, NULL, '2020-11-07 05:49:50', '2020-11-07 11:34:08', 1, NULL, 3, 2, 4),
(24, 'Jason Weins', 'jason@yahoo.com', NULL, '$2y$10$uRs2oujzEG49J29QmYPy.eV3/IjuFrPl1cMGdhmv.xCuyylNei9ya', NULL, NULL, 5, NULL, '2020-11-07 09:46:40', '2020-11-12 15:47:34', 1, NULL, 4, 3, 3),
(25, 'Danielle O\'Hare', 'danielle@yahoo.com', NULL, '$2y$10$F6z8nGfbjVcskgwC.q3NJuD5AflhuTsfyid0lvhq47B2ky.FYybQC', NULL, NULL, 22, NULL, '2020-11-07 11:35:32', '2020-11-07 11:35:32', 1, NULL, 4, 2, 2),
(26, 'Dora Explorer', 'dora@gmail.com', NULL, '$2y$10$Vt4TUy/3KQuRDHo5Ha6cCO9OTQ71IV5YFK/ZdXwT9PclRqDf62KI6', NULL, NULL, 6, NULL, '2020-11-07 11:44:35', '2020-11-07 14:01:53', 1, NULL, 4, 3, 4),
(27, 'Robert Pattinson', 'robert@yahoo.com', NULL, '$2y$10$B6miY0ubNnYBHmh0rXMzPO3sEeyoBbMrQDvN6NG5M515OexMWfeyq', NULL, NULL, 0, NULL, '2020-11-07 14:15:08', '2020-11-12 12:33:04', 1, NULL, 3, 4, 5),
(28, 'Robert Pattinson', 'robert@gmail.com', '2020-11-07 14:17:58', '$2y$10$dm8ETEZOyloRioSa5963SO/cxOqazANkDZmprs1FbhWQ7iV38DSuC', NULL, NULL, 0, NULL, '2020-11-07 14:17:44', '2020-11-12 14:14:46', 1, NULL, 4, 2, 4),
(29, 'Dan Abraham', 'danny@gmail.com', '2020-11-07 16:05:23', '$2y$10$hcWVVsE0EgfgbJ.GKGX6eOAHV6k7zC3C5sQPnkQYUre2PP.q.2cc.', NULL, NULL, 0, NULL, '2020-11-07 16:05:05', '2020-11-07 16:05:23', 0, NULL, NULL, NULL, NULL),
(30, 'Harriot Everfield', 'harriot@gmail.com', '2020-11-07 18:12:47', '$2y$10$ow17YNMmBiNGmjTkQni2Zu1uNcRpvy/pqsJzlzQ8Mo6x3bGZbrxN.', NULL, NULL, 0, NULL, '2020-11-07 18:12:09', '2020-11-07 18:25:17', 1, NULL, 4, 4, 5),
(33, 'Abraham Lincoln', 'abraham@yahoo.com', NULL, '$2y$10$x.rnLdzw2ZGd9vnKmcPDyuN05HhVX8gsBvczxFC.V3HGUFgppc45.', NULL, NULL, 2, NULL, '2020-11-08 05:05:15', '2020-11-12 14:03:06', 1, NULL, 5, 3, 5),
(34, 'Natasha Butterfield', 'natasha33@yahoo.com', NULL, '$2y$10$wgVa8Fa3BdtLgjuT5Ep6zOniTI6kH/w.vWI6.fqgqkaaWvrzr/nNK', NULL, NULL, 2, NULL, '2020-11-08 05:05:42', '2020-11-12 18:37:14', 1, NULL, 5, 3, 2),
(35, 'Margaret Beers', 'beer@yahoo.com', NULL, '$2y$10$pynGHbs7PelUBHidVvEXkeLlFqyJKZkPBhftxqHjDYaXPtxu9fl2.', NULL, NULL, 2, NULL, '2020-11-08 05:06:05', '2020-11-08 06:46:15', 1, NULL, 5, 3, 7),
(36, 'Filip Fernando', 'filipfur@gmail.com', NULL, '$2y$10$R.wmkR9lZqb400vsEbDw/.P79PVvZzDpFyYWxzjWhJoidBH4ZWEvK', NULL, NULL, 2, NULL, '2020-11-08 05:07:01', '2020-11-12 18:43:31', 1, NULL, 5, 3, 2),
(37, 'Harry Jacobs', 'harr@yahoo.com', NULL, '$2y$10$9zTtsxOk4jQ5I.PeVkaBfuNWy5akFofmmFnDiyjxA9KqTuxx4zA3y', NULL, NULL, 2, NULL, '2020-11-08 05:09:04', '2020-11-08 05:35:25', 1, NULL, 5, 2, 4),
(38, 'Matt Stonie', 'matthew@yahoo.com', NULL, '$2y$10$dFvMKrcaDO/Kl6KiNudAuukKCl9UISODOg5Zl2.ZLMILti9eRQlz.', NULL, NULL, 2, NULL, '2020-11-08 05:09:33', '2020-11-08 05:35:32', 1, NULL, 5, 2, 4),
(41, 'Dan Daniel', 'dan@gmail.com', NULL, '$2y$10$P.wjVJkYSFltXwFqfJPzROd86ofL1Z09LxhzXGm1yYkDDH58g2Ufa', NULL, NULL, 2, NULL, '2020-11-08 08:15:10', '2020-11-08 08:15:10', 1, NULL, 4, 2, 4),
(43, 'Aaron Fernando', 'aaron@yahoo.com', NULL, '$2y$10$uktnCOHUUveA1dvr.0Xe4eiAonkKclDeS2UjtgqLb4d9D4EcJsWJW', NULL, NULL, 4, NULL, '2020-11-12 13:37:09', '2020-11-12 13:37:09', 1, NULL, 4, 3, 4),
(45, 'Adam Savage', 'adam@gmail.com', NULL, '$2y$10$uK3xyW54dSMELlQx8.z67OxyadTCZbxy9uDJtTKipsF5FeLWC5fJa', NULL, NULL, 6, NULL, '2020-11-12 14:17:34', '2020-11-12 14:17:34', 1, NULL, 5, 3, 6),
(46, 'Daniel Radcliffe', 'harry@yahoo.com', NULL, '$2y$10$S1.JM2kapWqu9I4BRzLYBeLYZeJTaV3t1pz8V0K.xDpRWxP4g84YG', NULL, NULL, 3, NULL, '2020-11-12 18:52:26', '2020-11-12 18:52:26', 1, NULL, 4, 1, 3),
(47, 'Thomas Edison', 'tommy@gmail.com', NULL, '$2y$10$xavA2IRf/qoXKBaQevw9iOlVL3g7qyQcuXrVNPoFDUCJ2VS4ekVUy', NULL, NULL, 3, NULL, '2020-11-12 18:53:48', '2020-11-12 18:53:48', 1, NULL, 4, 3, 4),
(48, 'Jason Bateman', 'jasonbat@yahoo.com', '2021-03-31 23:26:27', '$2y$10$hf4IQX2f1QACX5hU3cACJOQ2FYbPWBxc0T8K8FI/o3cC0Tln2Om92', NULL, NULL, 0, NULL, '2021-03-31 23:24:48', '2021-03-31 23:40:28', 1, NULL, 2, 4, 4),
(49, 'Mojo', 'mojo@yahoo.com', '2021-03-31 23:52:19', '$2y$10$zHTmZ.gJ5mZSN/7ttAvJx.BdDbabNyy3jbyf6GuO470Zz9o/JBbT.', NULL, NULL, 0, NULL, '2021-03-31 23:41:30', '2021-03-31 23:52:19', 0, NULL, NULL, NULL, NULL),
(50, 'Danny', 'dumbo@yahoo.com', '2021-04-01 00:17:17', '$2y$10$t2nK7W1yw9NRwuJCQ/QwoOP5z9GG2Gd844oxOD3/7upo4wmn6zXzC', NULL, NULL, 0, NULL, '2021-04-01 00:16:26', '2021-04-01 00:17:17', 0, NULL, NULL, NULL, NULL),
(51, 'Asel', 'aa@yahoo.com', '2021-04-01 00:49:18', '$2y$10$p6w6A45Bnk3Zu.8iTlHzqe6..NZxpc4cDzTrWST9c4VH91AWz.EYW', NULL, NULL, 0, NULL, '2021-04-01 00:48:51', '2021-04-01 00:49:18', 0, NULL, NULL, NULL, NULL),
(52, 'Sharuka', 's@gmail.com', '2021-04-01 00:51:34', '$2y$10$5hwdjiLVCbcX8GERf7Mi3OoZbMGg9LRuYjwL/TtnUVPeYqd.V8NiK', NULL, NULL, 0, NULL, '2021-04-01 00:51:03', '2021-04-01 00:51:34', 0, NULL, NULL, NULL, NULL),
(53, 'xyz', 'xyz@yahoo.com', NULL, '$2y$10$HwTSWx7G7xVM6YtzpPF/qeGekoAZA3Ot4ha0FfqTgvmnJo/TYdsbG', NULL, NULL, 0, NULL, '2021-04-01 01:17:30', '2021-04-01 01:17:30', 0, NULL, NULL, NULL, NULL),
(54, 'test', 'testr@yahoo.com', NULL, '$2y$10$qs2qecz8PiplsJRI1Z40DOXGxoxs7Eh0kFNoatHiE3bM6NRbwvmHy', NULL, NULL, 0, NULL, '2021-04-01 01:31:15', '2021-04-01 01:31:15', 0, NULL, NULL, NULL, NULL),
(55, 'test', 'test453@yahoo.com', NULL, '$2y$10$Zr2Juh6ibWu/CLYwDaWYv.yLG..l4wAJnQqZSrYeoFMog.g9rx4Fy', NULL, NULL, 0, NULL, '2021-04-01 01:33:44', '2021-04-01 01:33:44', 0, NULL, NULL, NULL, NULL);


--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `access`, `created_at`, `updated_at`, `status`, `deleted_at`) VALUES
(1, 'General module', NULL, NULL, 7, NULL),
(2, 'Environment Module', NULL, NULL, 7, NULL),
(3, 'Organization Module', NULL, NULL, 7, NULL),
(4, 'Reporting Module', NULL, NULL, 7, NULL),
(6, 'Approval Item-Organization assigning', NULL, NULL, 7, NULL),
(7, 'Approval Item-Staff assigning and final approval', NULL, NULL, 7, NULL),
(8, 'Approval Item-Investigation', NULL, NULL, 7, NULL);

--
-- Dumping data for table `role_has_access`
--

INSERT INTO `role_has_access` (`id`, `created_at`, `updated_at`, `deleted_at`, `role_id`, `access_id`) VALUES
(1, '2021-04-02 06:01:07', '2021-04-02 06:01:07', NULL, 2, 1),
(2, '2021-04-02 06:01:07', '2021-04-02 06:01:07', NULL, 2, 2),
(3, '2021-04-02 06:01:07', '2021-04-02 06:01:07', NULL, 2, 3),
(4, '2021-04-02 06:01:07', '2021-04-02 06:01:07', NULL, 2, 4),
(5, '2021-04-02 06:01:07', '2021-04-02 06:01:07', NULL, 2, 6),
(6, '2021-04-02 06:01:07', '2021-04-02 06:01:07', NULL, 2, 7),
(7, '2021-04-02 06:01:07', '2021-04-02 06:01:07', NULL, 2, 8),
(8, '2021-04-03 08:10:53', '2021-04-03 08:10:53', NULL, 3, 1),
(9, '2021-04-03 08:10:53', '2021-04-03 08:10:53', NULL, 3, 2),
(10, '2021-04-03 08:10:53', '2021-04-03 08:10:53', NULL, 3, 3),
(11, '2021-04-03 08:10:53', '2021-04-03 08:10:53', NULL, 3, 4),
(12, '2021-04-03 08:10:54', '2021-04-03 08:10:54', NULL, 3, 6),
(13, '2021-04-03 08:10:54', '2021-04-03 08:10:54', NULL, 3, 7),
(14, '2021-04-03 08:10:54', '2021-04-03 08:10:54', NULL, 3, 8),
(15, '2021-04-03 08:11:03', '2021-04-03 08:11:03', NULL, 4, 1),
(16, '2021-04-03 08:11:03', '2021-04-03 08:11:03', NULL, 4, 2),
(17, '2021-04-03 08:11:03', '2021-04-03 08:11:03', NULL, 4, 3),
(18, '2021-04-03 08:11:03', '2021-04-03 08:11:03', NULL, 4, 4),
(19, '2021-04-03 08:11:03', '2021-04-03 08:11:03', NULL, 4, 6),
(20, '2021-04-03 08:11:03', '2021-04-03 08:11:03', NULL, 4, 7),
(21, '2021-04-03 08:11:04', '2021-04-03 08:11:04', NULL, 4, 8),
(22, '2021-04-03 08:11:14', '2021-04-03 08:11:14', NULL, 5, 1),
(23, '2021-04-03 08:11:14', '2021-04-03 08:11:14', NULL, 5, 2),
(24, '2021-04-03 08:11:14', '2021-04-03 08:11:14', NULL, 5, 3),
(25, '2021-04-03 08:11:14', '2021-04-03 08:11:14', NULL, 5, 4),
(26, '2021-04-03 08:11:14', '2021-04-03 08:11:14', NULL, 5, 6),
(27, '2021-04-03 08:11:14', '2021-04-03 08:11:14', NULL, 5, 7),
(28, '2021-04-03 08:11:14', '2021-04-03 08:11:14', NULL, 5, 8),
(29, '2021-04-03 08:11:23', '2021-04-03 08:11:23', NULL, 6, 1),
(30, '2021-04-03 08:11:23', '2021-04-03 08:11:23', NULL, 6, 2),
(31, '2021-04-03 08:11:23', '2021-04-03 08:11:23', NULL, 6, 3),
(32, '2021-04-03 08:11:23', '2021-04-03 08:11:23', NULL, 6, 4),
(33, '2021-04-03 08:11:23', '2021-04-03 08:11:23', NULL, 6, 6),
(34, '2021-04-03 08:11:23', '2021-04-03 08:11:23', NULL, 6, 7),
(35, '2021-04-03 08:11:23', '2021-04-03 08:11:23', NULL, 6, 8);

--
-- Dumping data for table `process_item_statuses`
--

INSERT INTO `process_item_statuses` (`id`, `status_title`, `created_at`, `updated_at`, `status`, `deleted_at`) VALUES
(1, 'Assign', NULL, NULL, 7, NULL),
(2, 'Review', NULL, NULL, 7, NULL),
(3, 'Recommended for special approval', NULL, NULL, 7, NULL),
(4, 'Not approved', NULL, NULL, 7, NULL),
(5, 'Approved', NULL, NULL, 7, NULL);

--
-- Dumping data for table `crime_types`
--

INSERT INTO `crime_types` (`id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Illegal transportation', NULL, NULL, NULL),
(2, 'Illegal tree cutting', NULL, NULL, NULL),
(3, 'Improper chemical waste disposal', NULL, NULL, NULL),
(4, 'Destruction of Forest Reserves', NULL, NULL, NULL),
(5, 'Dumping into oceans, streams, lakes, or rivers', NULL, NULL, NULL);

--
-- Dumping data for table `ecosystems_types_table`
--

INSERT INTO `ecosystems_types` (`id`, `type`, `created_at`, `updated_at`,  `deleted_at`) VALUES
(1, 'Forest and related Eco-Systems ', '2021-01-10 00:39:06', NULL,  NULL),
(2, 'Inland wetland Eco-Systems ', '2021-01-10 00:41:16', NULL,  NULL),
(3, 'Costal and marrine Eco-Systems ', '2021-01-10 00:41:16', NULL, NULL),
(4, 'Agricultural Eco-Systems', '2021-01-10 00:41:16', NULL, NULL);



-------- Add data in order so as not to trigger fk constraint errors